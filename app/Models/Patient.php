<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'date_of_birth',
        'city',
        'country',
        'blood_type',
        'allergies',
        'medical_notes',
        'image',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    protected $appends = [
        'full_name',
        'profile_image_url',
        'location_label',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }

    public function favourites()
    {
        return $this->hasMany(PatientFavourite::class, 'patient_id');
    }

    public function favouriteDoctors()
    {
        return $this->belongsToMany(Doctor::class, 'patient_favourites', 'patient_id', 'doctor_id');
    }

    public function getFullNameAttribute(): string
    {
        $fullName = trim(($this->first_name ?? '').' '.($this->last_name ?? ''));

        return $fullName !== '' ? $fullName : ($this->user?->name ?? 'Patient');
    }

    public function getProfileImageUrlAttribute(): string
    {
        return $this->image
            ? asset('storage/'.$this->image)
            : asset('front-end/assets/img/patients/patient.jpg');
    }

    public function getLocationLabelAttribute(): string
    {
        $location = trim(($this->city ?? '').', '.($this->country ?? ''), ' ,');

        return $location !== '' ? $location : ($this->user?->address ?: 'Address will be updated soon');
    }
}
