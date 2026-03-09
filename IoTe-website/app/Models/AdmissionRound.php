<?php
// FILE: app/Models/AdmissionRound.php
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

    // One round → many projects
    public function projects()
    {
        return $this->hasMany(AdmissionProject::class)->orderBy('sort_order');
    }

    // Auto-compute how many seats are spoken for by its projects
    public function getUsedSeatsAttribute(): int
    {
        return $this->projects->sum('seats');
    }
}
