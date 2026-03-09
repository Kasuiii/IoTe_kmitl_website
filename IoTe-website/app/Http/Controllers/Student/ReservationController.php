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
        $facultyCode = $this->getFacultyCode($user->email);

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
        $facultyCode = $this->getFacultyCode(Auth::user()->email);
        $itemAccess  = $item->faculty_access; // uses the accessor — empty "" becomes "all"

        $allowed = empty($itemAccess)
            || $itemAccess === 'all'
            || ($itemAccess === 'engineering' && $facultyCode === '01')
            || ($itemAccess === 'science'     && $facultyCode === '05');

        if (!$allowed) {
            return redirect()->route('reservations.index')
                ->with('error', 'คุณไม่มีสิทธิ์ยืมอุปกรณ์นี้');
        }

        return view('reservations.create', [
            'item'         => $item,
            'availableQty' => $item->real_available,
        ]);
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
        if ($reservation->user_id !== Auth::id() || $reservation->status !== 'pending') {
            return back()->with('error', 'ไม่สามารถยกเลิกได้');
        }

        $reservation->update(['status' => 'cancelled']);
        return back()->with('success', 'ยกเลิกคำขอสำเร็จ');
    }

    private function getFacultyCode(string $email): string
    {
        $local = explode('@', $email)[0];
        if (strlen($local) >= 4) {
            $code = substr($local, 2, 2);
            if ($code === '01') return '01';
            if ($code === '05') return '05';
        }
        return 'all';
    }
}
