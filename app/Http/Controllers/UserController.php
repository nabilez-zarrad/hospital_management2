<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;

class UserController extends Controller
{
    public function Dashboard()
    {
        // If you still have /dashboard route pointing here, keep it working without sections.
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'doctor') {
            return redirect()->route('doctor.dashboard');
        }

        // patient
        return redirect('/');
    }

    public function Index()
    {
        $doctors = Doctor::query()->latest()->take(8)->get();
        return view('index', compact('doctors'));
    }

    public function doctors()
    {
        $doctors = Doctor::query()->latest()->get();
        return view('doctors', compact('doctors'));
    }

    public function doctorDetails($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctor.details', compact('doctor'));
    }

    public function bookAppointment(Request $request)
    {
        $request->validate([
            'doctor_id' => ['required', 'exists:doctors,id'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required'],
        ]);

        if (!Auth::check() || Auth::user()->role !== 'patient') {
            return redirect()->route('login')->with('error', 'Only patients can book appointments.');
        }

        $patient = Patient::where('user_id', Auth::id())->first();
        if (!$patient) {
            return back()->with('error', 'Patient profile not found.');
        }

        Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'consulting_fee' => 0,
            'booking_fee' => 0,
            'video_fee' => 0,
            'total' => 0,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Appointment booked successfully.');
    }

    public function myAppointments()
    {
        if (!Auth::check() || Auth::user()->role !== 'patient') {
            return redirect()->route('login');
        }

        $patient = Patient::where('user_id', Auth::id())->first();
        if (!$patient) {
            return redirect('/')->with('error', 'Patient profile not found.');
        }

        $appointments = Appointment::with('doctor')
            ->where('patient_id', $patient->id)
            ->latest()
            ->get();

        return view('my_appointments', compact('appointments'));
    }

    public function cancelAppointment($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'patient') {
            return redirect()->route('login');
        }

        $patient = Patient::where('user_id', Auth::id())->first();
        if (!$patient) {
            return redirect('/')->with('error', 'Patient profile not found.');
        }

        $appointment = Appointment::where('patient_id', $patient->id)->findOrFail($id);
        $appointment->status = 'cancelled';
        $appointment->save();

        return back()->with('success', 'Appointment cancelled.');
    }
}