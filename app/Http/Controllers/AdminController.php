<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $doctorsCount = Doctor::count();
        $patientsCount = Patient::count();
        $appointmentsCount = Appointment::count();
        $specialtiesCount = Specialty::count();

        $appointmentsByStatus = Appointment::select('status', DB::raw('count(*) as aggregate'))
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        return view('admin.dashboard', compact(
            'doctorsCount',
            'patientsCount',
            'appointmentsCount',
            'specialtiesCount',
            'appointmentsByStatus'
        ));
    }

    public function createDoctor()
    {
        $specialties = Specialty::orderBy('name')->get();

        return view('admin.add_doctor', compact('specialties'));
    }

    public function storeDoctor(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female',
            'date_of_birth' => 'nullable|date',
            'speciality' => 'nullable|string|max:255',
            'specialty_id' => 'nullable|exists:specialties,id',
            'clinic_name' => 'nullable|string|max:255',
            'clinic_address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'price' => 'nullable|numeric|min:0',
            'is_free' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $image = $request->hasFile('image')
            ? $request->file('image')->store('doctors', 'public')
            : null;

        DB::transaction(function () use ($validated, $image) {
            $user = User::create([
                'name' => trim($validated['first_name'] . ' ' . $validated['last_name']),
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'] ?? 'Doctor@12345'),
                'role' => 'doctor',
            ]);

            Doctor::create([
                'user_id' => $user->id,
                'username' => $user->name,
                'email' => $user->email,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone' => $validated['phone'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'speciality' => $validated['speciality'] ?? null,
                'specialty_id' => $validated['specialty_id'] ?? null,
                'clinic_name' => $validated['clinic_name'] ?? null,
                'clinic_address' => $validated['clinic_address'] ?? null,
                'city' => $validated['city'] ?? null,
                'state' => $validated['state'] ?? null,
                'country' => $validated['country'] ?? null,
                'postal_code' => $validated['postal_code'] ?? null,
                'price' => $validated['price'] ?? 0,
                'is_free' => (bool) ($validated['is_free'] ?? true),
                'rating' => 0,
                'total_reviews' => 0,
                'image' => $image,
            ]);
        });

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor added successfully.');
    }
}
