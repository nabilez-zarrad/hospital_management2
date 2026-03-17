<?php

namespace App\Http\Controllers;
use App\Models\Medecin;
use Illuminate\Http\Request;
use App\Models\Rendezvous;
use Illuminate\Support\Facades\Auth;
class DoctorController extends Controller
{

public function appointments()
{
    $medecin_id = Auth::id();
    $appointments = Rendezvous::with('patient','section')->where('medecin_id',$medecin_id)->latest()->get();
    return view('medecin.appointments',compact('appointments'));
}

public function doctor_profile_settings()
{

    $doctor = Medecin::where('email', Auth::user()->email)->first();
    return view('medecin.doctor_profile_settings', compact('doctor'));

}
public function my_patients()
{
 return view('medecin.my_patients');
}
public function schedule_timings()
{
 return view('medecin.schedule_timings' );
}







public function acceptAppointment($id)
{

$appointment = Rendezvous::where('medecin_id',Auth::id())
->findOrFail($id);

$appointment->statut = 'confirme';

$appointment->save();

return back()->with('success','Appointment confirmed');

}

public function cancelAppointmentDoctor($id)
{

$appointment = Rendezvous::where('medecin_id',Auth::id())
->findOrFail($id);

$appointment->statut = 'annule';

$appointment->save();

return back()->with('success','Appointment cancelled');

}

}