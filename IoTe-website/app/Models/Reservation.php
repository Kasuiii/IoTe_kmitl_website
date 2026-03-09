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

    // Status flow:
    // pending → approved → borrowed → returned
    //         → rejected
    // pending → cancelled  (by student)
    public static array $statusLabels = [
        'pending'   => ['label' => 'รอการอนุมัติ', 'color' => '#f97316'],
        'approved'  => ['label' => 'อนุมัติแล้ว',  'color' => '#3b82f6'],
        'borrowed'  => ['label' => 'กำลังยืม',     'color' => '#dc2626'],
        'returned'  => ['label' => 'คืนแล้ว',      'color' => '#16a34a'],
        'rejected'  => ['label' => 'ไม่อนุมัติ',   'color' => '#6b7280'],
        'cancelled' => ['label' => 'ยกเลิก',       'color' => '#9ca3af'],
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::$statusLabels[$this->status]['label'] ?? $this->status;
    }

    public function getStatusColorAttribute(): string
    {
        return self::$statusLabels[$this->status]['color'] ?? '#6b7280';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(ReservableItem::class, 'reservable_item_id');
    }

    public function getIsOverdueAttribute(): bool
    {
        return $this->status === 'borrowed' && $this->return_date->isPast();
    }
}
