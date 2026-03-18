<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;

class AdminController extends Controller
{

  public function createDoctor()
{
    $doctors = Doctor::latest()->get();
    return view('admin.add_doctor', compact('doctors'));
}

    public function storeDoctor(Request $request)
    {

        $image = null;

        if($request->hasFile('image'))
        {
            $image = $request->file('image')->store('doctors','public');
        }

        // This legacy form will need a proper Doctor+User creation flow later.
        Doctor::create([
            'user_id' => $request->user_id, // optional in current legacy form
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'biography' => $request->biography,
            'speciality' => $request->speciality,
            'clinic_name' => $request->clinic_name,
            'clinic_address' => $request->clinic_address,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'price' => $request->price ?? 0,
            'is_free' => (bool)($request->is_free ?? true),
            'rating' => 0,
            'total_reviews' => 0,
            'image' => $image,
        ]);

        return back()->with('success','Doctor Added Successfully');

    }

}