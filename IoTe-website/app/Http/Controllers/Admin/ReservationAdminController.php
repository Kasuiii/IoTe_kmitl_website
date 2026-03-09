<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['user', 'item'])->latest();

        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $reservations = $query->paginate(20);
        $statusOptions = array_keys(Reservation::$statusLabels);

        return view('reservations.admin', compact('reservations', 'statusOptions'));
    }

    // Update reservation status
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status'       => 'required|in:pending,approved,borrowed,returned,rejected,cancelled',
            'admin_notes'  => 'nullable|string',
        ]);

        $reservation->update([
            'status'      => $request->status,
            'admin_notes' => $request->admin_notes,
            // Set actual return date when marking as returned
            'actual_return_date' => $request->status === 'returned' ? now()->toDateString() : $reservation->actual_return_date,
        ]);

        return back()->with('success', 'อัปเดตสถานะการยืมสำเร็จ!');
    }
}
