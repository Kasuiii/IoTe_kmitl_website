<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ReservableItem;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $user        = Auth::user();
        $facultyCode = $user->faculty_code ?? $this->detectFacultyFromEmail($user->email);

        $items = ReservableItem::accessibleBy($facultyCode)
            ->orderBy('category')->orderBy('name')->get();

        $byCategory = $items->groupBy('category');

        $myActiveReservations = Reservation::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved', 'borrowed'])
            ->with('item')->latest()->get();

        return view('reservations.index', compact('byCategory', 'myActiveReservations', 'user'));
    }

    public function history()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with('item')->latest()->paginate(15);

        return view('reservations.history', compact('reservations'));
    }

    public function create(ReservableItem $item)
    {
        $user        = Auth::user();
        $facultyCode = $user->faculty_code ?? $this->detectFacultyFromEmail($user->email);

        $allowed = $item->faculty_access === 'all'
            || ($item->faculty_access === 'engineering' && $facultyCode === '01')
            || ($item->faculty_access === 'science'     && $facultyCode === '05');

        if (!$allowed) {
            return redirect()->route('reservations.index')
                ->with('error', 'คุณไม่มีสิทธิ์ยืมอุปกรณ์นี้');
        }

        $availableQty = $item->real_available;

        return view('reservations.create', compact('item', 'availableQty'));
    }

    public function store(Request $request, ReservableItem $item)
    {
        $data = $request->validate([
            'quantity_requested' => 'required|integer|min:1',
            'borrow_date'        => 'required|date|after_or_equal:today',
            'return_date'        => 'required|date|after:borrow_date',
            'purpose'            => 'required|string|max:500',
        ]);

        $days = \Carbon\Carbon::parse($data['borrow_date'])
            ->diffInDays(\Carbon\Carbon::parse($data['return_date']));

        if ($days > $item->max_borrow_days) {
            return back()->withErrors([
                'return_date' => "ระยะเวลายืมสูงสุด {$item->max_borrow_days} วัน",
            ])->withInput();
        }

        // Count how many units are already reserved in the requested date range
        $reservedQty = Reservation::where('reservable_item_id', $item->id)
            ->whereIn('status', ['pending', 'approved', 'borrowed'])
            ->where(function ($q) use ($data) {
                $q->where('borrow_date', '<=', $data['return_date'])
                    ->where('return_date', '>=', $data['borrow_date']);
            })
            ->sum('quantity_requested');

        $availableQty = $item->quantity_total - $reservedQty;

        if ($data['quantity_requested'] > $availableQty) {
            return back()->withErrors([
                'quantity_requested' => "อุปกรณ์ไม่พอในช่วงเวลาที่เลือก (เหลือ {$availableQty})",
            ])->withInput();
        }

        Reservation::create([
            ...$data,
            'user_id'            => Auth::id(),
            'reservable_item_id' => $item->id,
            'status'             => 'pending',
        ]);

        return redirect()->route('reservations.history')
            ->with('success', 'ส่งคำขอยืมอุปกรณ์สำเร็จ! รอการอนุมัติ');
    }

    public function cancel(Reservation $reservation)
    {
        // Students can only cancel their OWN pending reservations
        if ($reservation->user_id !== Auth::id() || $reservation->status !== 'pending') {
            return back()->with('error', 'ไม่สามารถยกเลิกได้');
        }

        $reservation->update(['status' => 'cancelled']);
        return back()->with('success', 'ยกเลิกคำขอสำเร็จ');
    }

    private function detectFacultyFromEmail(string $email): string
    {
        if (preg_match('/6701/', $email)) return '01'; // engineering
        if (preg_match('/6705/', $email)) return '05'; // science
        return 'all';
    }
}
