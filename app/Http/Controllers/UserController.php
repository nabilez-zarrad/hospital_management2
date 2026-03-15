<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Section;
use App\Models\Medecin;
use App\Models\Rendezvous;

class UserController extends Controller
{
<<<<<<< HEAD

    public function Dashboard()
    {
        $sections = Section::all();
        $medecins = Medecin::with('section','image')->take(6)->get();

        if(Auth::check() && Auth::user()->user_type == 'user'){
            return view("index", compact('sections','medecins'));
        }
        elseif(Auth::check() && Auth::user()->user_type == 'admin'){
            return view("admin.dashboard");
        }
=======
    public function Dashboard(){
        if(Auth::check()&&Auth::user()->user_type=='user')
            {
             return view("index");  
            }
        else if(Auth::check()&&Auth::user()->user_type=='admin')
            {
             return view("admin.dashboard");  
            }
            else if(Auth::check()&&Auth::user()->user_type=="medecin")
            {
             return view("medecin.dashboard");
            }
>>>>>>> b068db4a55c9fe982efd0edb2a6f286eb460919c
        else{
            return redirect('/');
        }
    }

    public function Index()
    {
        $sections = Section::all();
        $medecins = Medecin::with('section','image')->take(6)->get();

        return view('index', compact('sections','medecins'));
    }

  public function doctors()
{
    $sections = Section::all();
    $medecins = Medecin::with('section','image')->get();

    return view('doctors', compact('medecins','sections'));
}
public function doctorProfile($id)
{
    $medecin = Medecin::with('section','image')->findOrFail($id);

    return view('doctor_profile', compact('medecin'));
}
public function bookAppointment(Request $request)
{
    $request->validate([
        'medecin_id' => 'required',
        'date_rendezvous' => 'required'
    ]);

    Rendezvous::create([
        'patient_id' => Auth::id(),
        'medecin_id' => $request->medecin_id,
        'section_id' => $request->section_id,
        'date_rendezvous' => $request->date_rendezvous,
        'statut' => 'non confirmé'
    ]);

    return back()->with('success','Appointment booked successfully');
}
public function myAppointments()
{
    $appointments = Rendezvous::with('medecin','section')
        ->where('patient_id', Auth::id())
        ->get();

    return view('my_appointments', compact('appointments'));
}
public function cancelAppointment($id)
{
    $appointment = Rendezvous::findOrFail($id);

    if($appointment->patient_id == Auth::id())
    {
        $appointment->delete();
    }

    return back()->with('success','Appointment cancelled');
}
public function searchDoctors(Request $request)
{
    $query = $request->search;

    $medecins = Medecin::with('section')
        ->where('name','LIKE',"%$query%")
        ->orWhereHas('section', function($q) use ($query){
            $q->where('name','LIKE',"%$query%");
        })
        ->get();

    return view('doctors', compact('medecins'));
}
}