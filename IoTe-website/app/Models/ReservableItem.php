<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservableItem extends Model
{
    protected $fillable = [
        'name',
        'category',
        'description',
        'image_url',
        'faculty_access',
        'quantity_total',
        'quantity_available',
        'max_borrow_days',
        'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    // Treat empty string the same as 'all'
    public function getFacultyAccessAttribute($value): string
    {
        return (empty($value)) ? 'all' : $value;
    }

    public function getCurrentlyBorrowedAttribute(): int
    {
        return $this->reservations()
            ->whereIn('status', ['approved', 'borrowed'])
            ->sum('quantity_requested');
    }

    public function getRealAvailableAttribute(): int
    {
        return max(0, $this->quantity_total - $this->currently_borrowed);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function scopeAccessibleBy($query, string $facultyCode)
    {
        if ($facultyCode === 'all') {
            return $query->where('is_active', true);
        }

        $facultyName = $facultyCode === '01' ? 'engineering' : 'science';

        return $query->where(function ($q) use ($facultyName) {
            // empty string = all, so include it too
            $q->where('faculty_access', 'all')
                ->orWhere('faculty_access', '')
                ->orWhereNull('faculty_access')
                ->orWhere('faculty_access', $facultyName);
        })->where('is_active', true);
    }
}
