<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Doctor;
use App\Models\Patient;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 🩺 relation doctor
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    // 👤 relation patient
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    public function getRoleDashboardRouteAttribute(): string
    {
        return match ($this->role) {
            'admin' => route('admin.dashboard'),
            'doctor' => route('doctor.dashboard'),
            default => route('patient.dashboard'),
        };
    }
}
