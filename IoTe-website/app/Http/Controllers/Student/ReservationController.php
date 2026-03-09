<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ReservableItem;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // ── BROWSE available items ────────────────────────────────
    public function index()
    {
        $user = Auth::user();
        $facultyCode = $user->faculty_code ?? 'all';

        // accessibleBy() scope filters items the student is allowed to borrow
        $items = ReservableItem::accessibleBy($facultyCode)
            ->orderBy('category')
            ->orderBy('name')
            ->get();

        // Group by category for better display
        $byCategory = $items->groupBy('category');

        // Also get this user's active reservations
        $myActiveReservations = Reservation::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved', 'borrowed'])
            ->with('item')
            ->latest()
            ->get();

        return view('student.reservations.index', compact('byCategory', 'myActiveReservations', 'user'));
    }

    // ── SHOW reservation history ──────────────────────────────
    public function history()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)
            ->with('item')
            ->latest()
            ->paginate(15);
        return view('student.reservations.history', compact('reservations'));
    }

    // ── SHOW reservation form ─────────────────────────────────
    public function create(ReservableItem $item)
    {
        $user = Auth::user();
        $facultyCode = $user->faculty_code ?? 'all';

        // Check if this student is ALLOWED to borrow this item
        $allowed = $item->faculty_access === 'all'
            || ($item->faculty_access === 'engineering' && $facultyCode === '01')
            || ($item->faculty_access === 'science'     && $facultyCode === '05');

        if (!$allowed) {
            return redirect()->route('student.reservations.index')
                ->with('error', 'คุณไม่มีสิทธิ์ยืมอุปกรณ์นี้');
        }

        // How many is actually available right now?
        $availableQty = $item->real_available;

        return view('student.reservations.create', compact('item', 'availableQty', 'user'));
    }

    // ── SAVE reservation request ──────────────────────────────
    public function store(Request $request, ReservableItem $item)
    {
        $user = Auth::user();

        $data = $request->validate([
            'quantity_requested' => 'required|integer|min:1',
            'borrow_date'        => 'required|date|after_or_equal:today',
            'return_date'        => 'required|date|after:borrow_date',
            'purpose'            => 'required|string|max:500',
        ]);

        // Check qty does not exceed available
        if ($data['quantity_requested'] > $item->real_available) {
            return back()->withErrors(['quantity_requested' => 'จำนวนที่ขอเกินจำนวนที่มีในคลัง']);
        }

        // Check the borrow period doesn't exceed max_borrow_days
        $days = \Carbon\Carbon::parse($data['borrow_date'])
            ->diffInDays(\Carbon\Carbon::parse($data['return_date']));
        if ($days > $item->max_borrow_days) {
            return back()->withErrors(['return_date' => "ระยะเวลายืมสูงสุด {$item->max_borrow_days} วัน"]);
        }

        Reservation::create([
            ...$data,
            'user_id'            => $user->id,
            'reservable_item_id' => $item->id,
            'status'             => 'pending',
        ]);

        return redirect()->route('student.reservations.index')
            ->with('success', 'ส่งคำขอยืมอุปกรณ์สำเร็จ! รอการอนุมัติจากเจ้าหน้าที่');
    }

    // ── CANCEL a pending reservation ─────────────────────────
    public function cancel(Reservation $reservation)
    {
        $user = Auth::user();

        // Students can only cancel THEIR OWN pending reservations
        if ($reservation->user_id !== $user->id || $reservation->status !== 'pending') {
            return back()->with('error', 'ไม่สามารถยกเลิกได้');
        }

        $reservation->update(['status' => 'cancelled']);
        return back()->with('success', 'ยกเลิกคำขอสำเร็จ');
    }
}
