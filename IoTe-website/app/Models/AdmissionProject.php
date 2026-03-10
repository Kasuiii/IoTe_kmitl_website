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
    public function round()
    {
        return $this->belongsTo(AdmissionRound::class, 'admission_round_id');
    }

    public function getRequirementsArrayAttribute(): array
    {
        if (!$this->requirements) return [];
        return array_map('trim', explode("\n", $this->requirements));
    }
}
