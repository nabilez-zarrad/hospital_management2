<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'user_id',
        'username',
        'email',
        'first_name',
        'last_name',
        'phone',
        'speciality',
        'price',
        'is_free',
        'rating',
        'total_reviews',
        'image',
        'gender',
        'date_of_birth',
        'biography',
        'clinic_name',
        'clinic_address',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'country',
        'postal_code',
        'section_id',
        'specialty_id',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_free' => 'boolean',
        'price' => 'decimal:2',
        'rating' => 'decimal:2',
    ];

    protected $appends = [
        'full_name',
        'profile_image_url',
        'specialty_label',
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

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function favouritedByPatients()
    {
        return $this->belongsToMany(Patient::class, 'patient_favourites', 'doctor_id', 'patient_id');
    }

    public function clinicImages()
    {
        return $this->hasMany(DoctorClinicImage::class);
    }

    public function services()
    {
        return $this->hasMany(DoctorService::class);
    }

    public function specializations()
    {
        return $this->hasMany(DoctorSpecialization::class);
    }

    public function educations()
    {
        return $this->hasMany(DoctorEducation::class);
    }

    public function experiences()
    {
        return $this->hasMany(DoctorExperience::class);
    }

    public function awards()
    {
        return $this->hasMany(DoctorAward::class);
    }

    public function memberships()
    {
        return $this->hasMany(DoctorMembership::class);
    }

    public function registrations()
    {
        return $this->hasMany(DoctorRegistration::class);
    }

    public function getFullNameAttribute(): string
    {
        $fullName = trim(($this->first_name ?? '').' '.($this->last_name ?? ''));

        return $fullName !== '' ? $fullName : 'Doctor';
    }

    public function getProfileImageUrlAttribute(): string
    {
        return $this->image
            ? asset('storage/'.$this->image)
            : asset('front-end/assets/img/doctors/doctor-thumb-01.jpg');
    }

    public function getSpecialtyLabelAttribute(): string
    {
        return $this->speciality
            ?? $this->specialty?->name
            ?? $this->section?->name
            ?? 'General Physician';
    }

    public function getLocationLabelAttribute(): string
    {
        $location = trim(($this->city ?? '').', '.($this->country ?? ''), ' ,');

        return $location !== '' ? $location : 'Clinic location will be updated soon';
    }
}
