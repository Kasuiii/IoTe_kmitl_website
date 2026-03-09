<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'reservable_item_id',
        'quantity_requested',
        'borrow_date',
        'return_date',
        'actual_return_date',
        'status',
        'purpose',
        'admin_notes',
    ];

    protected $casts = [
        'borrow_date'        => 'date',
        'return_date'        => 'date',
        'actual_return_date' => 'date',
    ];

    // STATUS FLOW:
    // pending → approved → borrowed → returned
    //         → rejected
    // pending → cancelled (by student)
    public static array $statusLabels = [
        'pending'   => ['label' => 'รอการอนุมัติ',  'color' => 'orange'],
        'approved'  => ['label' => 'อนุมัติแล้ว',  'color' => 'blue'],
        'borrowed'  => ['label' => 'กำลังยืม',     'color' => 'crimson'],
        'returned'  => ['label' => 'คืนแล้ว',      'color' => 'green'],
        'rejected'  => ['label' => 'ไม่อนุมัติ',   'color' => 'red'],
        'cancelled' => ['label' => 'ยกเลิก',       'color' => 'gray'],
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::$statusLabels[$this->status]['label'] ?? $this->status;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(ReservableItem::class, 'reservable_item_id');
    }

    // Check if reservation is overdue
    public function getIsOverdueAttribute(): bool
    {
        return $this->status === 'borrowed' && $this->return_date->isPast();
    }
}
