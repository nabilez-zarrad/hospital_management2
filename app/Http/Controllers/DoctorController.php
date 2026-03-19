<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Appointment;

class DoctorController extends Controller
{
    public function dashboard()
    {
        return view('doctor.dashboard');
    }


public function appointments()
{
    $doctor = Doctor::where('user_id', Auth::id())->first();

    if (!$doctor) {
        return "Had user machi doctor ❌";
    }

    $appointments = Appointment::with('patient')
        ->where('doctor_id', $doctor->id)
        ->latest()
        ->get();

    return view('doctor.appointments', compact('appointments'));
}

    public function profile_settings()
    {
        $doctor = Doctor::where('user_id', Auth::id())->first();

        return view('doctor.profile_settings', compact('doctor'));
    }

    public function my_patients()
    {
        return view('doctor.my_patients');
    }

    public function schedule_timings()
    {
        return view('doctor.schedule_timings');
    }

    public function acceptAppointment($id)
    {
        $doctor = Doctor::where('user_id', Auth::id())->first();

        $appointment = Appointment::where('doctor_id', $doctor->id)
            ->findOrFail($id);

        $appointment->status = 'approved';
        $appointment->save();

        return back()->with('success', 'Appointment approved');
    }

    public function cancelAppointmentDoctor($id)
    {
        $doctor = Doctor::where('user_id', Auth::id())->first();

        $appointment = Appointment::where('doctor_id', $doctor->id)
            ->findOrFail($id);

        $appointment->status = 'cancelled';
        $appointment->save();

        return back()->with('success', 'Appointment cancelled');
    }
}