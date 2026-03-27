<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Section;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        $sections = collect([
            'Cardiology',
            'Dentistry',
            'Dermatology',
        ])->map(fn ($name) => Section::firstOrCreate(['name' => $name]));

        $specialties = collect([
            'Cardiology',
            'Dentistry',
            'Dermatology',
        ])->map(fn ($name) => Specialty::firstOrCreate(['name' => $name]));

        $doctors = collect();
        for ($i = 1; $i <= 5; $i++) {
            $doctorUser = User::firstOrCreate(
                ['email' => "doctor{$i}@example.com"],
                [
                    'name' => "Doctor {$i}",
                    'password' => Hash::make('password'),
                    'role' => 'doctor',
                ]
            );

            $doctor = Doctor::firstOrCreate(
                ['user_id' => $doctorUser->id],
                [
                    'first_name' => "Doctor{$i}",
                    'last_name' => 'Test',
                    'phone' => "060000000{$i}",
                    'speciality' => $specialties[$i % $specialties->count()]->name,
                    'specialty_id' => $specialties[$i % $specialties->count()]->id,
                    'section_id' => $sections[$i % $sections->count()]->id,
                    'price' => rand(100, 300),
                    'is_free' => (bool) rand(0, 1),
                    'rating' => rand(3, 5),
                    'total_reviews' => rand(1, 20),
                ]
            );

            $doctors->push($doctor);
        }

        for ($i = 1; $i <= 5; $i++) {
            $patientUser = User::firstOrCreate(
                ['email' => "patient{$i}@example.com"],
                [
                    'name' => "Patient {$i}",
                    'password' => Hash::make('password'),
                    'role' => 'patient',
                ]
            );

            $patient = Patient::firstOrCreate(
                ['user_id' => $patientUser->id],
                [
                    'first_name' => "Patient{$i}",
                    'last_name' => 'Test',
                    'phone' => "070000000{$i}",
                    'city' => 'Fes',
                    'country' => 'Morocco',
                ]
            );

            Appointment::firstOrCreate(
                [
                    'patient_id' => $patient->id,
                    'doctor_id' => $doctors[$i % $doctors->count()]->id,
                    'appointment_date' => now()->addDays($i)->toDateString(),
                    'appointment_time' => '10:00',
                ],
                [
                    'consulting_fee' => 100,
                    'booking_fee' => 5,
                    'video_fee' => 0,
                    'total' => 105,
                    'status' => 'pending',
                ]
            );
        }
    }
}
