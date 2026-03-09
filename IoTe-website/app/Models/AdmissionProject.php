<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionProject extends Model
{
    protected $fillable = [
        'admission_round_id',
        'project_name',
        'project_name_th',
        'seats',
        'requirements',
        'score_criteria',
        'gpax_min',
        'notes',
        'sort_order',
    ];

    // Many projects → one round (the "belongs to" side)
    public function round()
    {
        return $this->belongsTo(AdmissionRound::class, 'admission_round_id');
    }

    // Parse requirements stored as comma-separated text into an array
    public function getRequirementsArrayAttribute(): array
    {
        if (!$this->requirements) return [];
        return array_map('trim', explode("\n", $this->requirements));
    }
}
