<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionRound extends Model
{
    protected $fillable = [
        'round_number',
        'round_name',
        'round_name_th',
        'total_seats',
        'badge_color',
        'description',
        'sort_order',
    ];
    public function projects()
    {
        return $this->hasMany(AdmissionProject::class)->orderBy('sort_order');
    }
    public function getUsedSeatsAttribute(): int
    {
        return $this->projects->sum('seats');
    }
}
