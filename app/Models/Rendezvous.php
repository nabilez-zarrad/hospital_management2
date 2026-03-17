<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Medecin;
use App\Models\Section;
use App\Models\Patient;

class Rendezvous extends Model
{
    use HasFactory;

    protected $table = 'rendezvous';

    protected $fillable = [

        'patient_id',
        'medecin_id',
        'section_id',
        'date_rendezvous',
        'statut'

    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class,'medecin_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }

}