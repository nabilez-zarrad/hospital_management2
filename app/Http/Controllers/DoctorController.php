<?php

namespace App\Http\Controllers;



use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorAward;
use App\Models\DoctorClinicImage;
use App\Models\DoctorEducation;
use App\Models\DoctorExperience;
use App\Models\DoctorMembership;
use App\Models\DoctorRegistration;
use App\Models\DoctorService;
use App\Models\DoctorSpecialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function dashboard()
    {
        $doctor = Doctor::with(['specialty', 'section'])->where('user_id', Auth::id())->first();
        if (! $doctor) {
            return redirect()->route('profile.edit')
                ->with('error', 'Doctor profile is not set up for this account.');
        }

        $appointments = Appointment::with('patient.user')
            ->where('doctor_id', $doctor->id)
            ->latest('appointment_date')
            ->latest('appointment_time')
            ->take(10)
            ->get();

        $patientsCount = Appointment::where('doctor_id', $doctor->id)->distinct('patient_id')->count('patient_id');
        $todayAppointmentsCount = Appointment::where('doctor_id', $doctor->id)->whereDate('appointment_date', now())->count();
        $totalAppointmentsCount = Appointment::where('doctor_id', $doctor->id)->count();

        $dashboardCards = [
            [
                'title' => 'Total Patients',
                'value' => $patientsCount,
                'icon' => 'fas fa-user-injured',
                'gradient' => 'linear-gradient(135deg, #10b981, #059669)',
                'meta' => null,
            ],
            [
                'title' => 'Today Appointments',
                'value' => $todayAppointmentsCount,
                'icon' => 'fas fa-calendar-day',
                'gradient' => 'linear-gradient(135deg, #f59e0b, #ea580c)',
                'meta' => now()->format('Y-m-d'),
            ],
            [
                'title' => 'Total Appointments',
                'value' => $totalAppointmentsCount,
                'icon' => 'fas fa-notes-medical',
                'gradient' => 'linear-gradient(135deg, #0ea5e9, #2563eb)',
                'meta' => null,
            ],
        ];

        return view('doctor.dashboard', [
            'doctor' => $doctor,
            'appointments' => $appointments,
            'dashboardCards' => $dashboardCards,
        ]);
    }

    public function appointments()
    {
        $doctor = Doctor::with(['specialty', 'section'])->where('user_id', Auth::id())->first();
        if (! $doctor) {
            return redirect()->route('profile.edit')
                ->with('error', 'Doctor profile is not set up for this account.');
        }

        $appointments = Appointment::with('patient.user')
            ->where('doctor_id', $doctor->id)
            ->latest('appointment_date')
            ->latest('appointment_time')
            ->get();

        return view('doctor.appointments', compact('appointments', 'doctor'));
    }

    public function profile_settings()
    {
        $doctor = Doctor::with([
            'clinicImages',
            'services',
            'specializations',
            'educations',
            'experiences',
            'awards',
            'memberships',
            'registrations',
        ])->where('user_id', Auth::id())->first();

        if (! $doctor) {
            return redirect()->route('profile.edit')
                ->with('error', 'Doctor profile is not set up for this account.');
        }

        return view('doctor.profile_settings', compact('doctor'));
    }

    public function updateProfileSettings(Request $request)
    {
        $doctor = Doctor::where('user_id', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'username' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'gender' => 'nullable|in:male,female',
            'date_of_birth' => 'nullable|date',
            'biography' => 'nullable|string',
            'clinic_name' => 'nullable|string|max:255',
            'clinic_address' => 'nullable|string|max:255',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:50',
            'price' => 'nullable|numeric|min:0',
            'is_free' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'clinic_images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'services' => 'nullable|string',
            'specializations' => 'nullable|string',
            'education_degree.*' => 'nullable|string|max:255',
            'education_college.*' => 'nullable|string|max:255',
            'education_year.*' => 'nullable|string|max:50',
            'experience_hospital.*' => 'nullable|string|max:255',
            'experience_from.*' => 'nullable|string|max:50',
            'experience_to.*' => 'nullable|string|max:50',
            'experience_designation.*' => 'nullable|string|max:255',
            'award_name.*' => 'nullable|string|max:255',
            'award_year.*' => 'nullable|string|max:50',
            'membership_name.*' => 'nullable|string|max:255',
            'registration_name.*' => 'nullable|string|max:255',
            'registration_year.*' => 'nullable|string|max:50',
        ]);

        DB::transaction(function () use ($request, $doctor, $validated) {
            $newImagePath = null;
            $oldImagePath = $doctor->image;

            if ($request->hasFile('image')) {
                $newImagePath = $request->file('image')->store('doctors', 'public');
            }

            if ((int) $validated['is_free'] === 1) {
                $validated['price'] = 0;
            }

            $doctor->update([
                'username' => $validated['username'] ?? null,
                'email' => $validated['email'] ?? null,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone' => $validated['phone'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'biography' => $validated['biography'] ?? null,
                'clinic_name' => $validated['clinic_name'] ?? null,
                'clinic_address' => $validated['clinic_address'] ?? null,
                'address_line_1' => $validated['address_line_1'] ?? null,
                'address_line_2' => $validated['address_line_2'] ?? null,
                'city' => $validated['city'] ?? null,
                'state' => $validated['state'] ?? null,
                'country' => $validated['country'] ?? null,
                'postal_code' => $validated['postal_code'] ?? null,
                'price' => $validated['price'] ?? 0,
                'is_free' => $validated['is_free'],
                'image' => $newImagePath ?? $doctor->image,
            ]);

            if ($doctor->user) {
                $doctor->user->update([
                    'name' => trim(($validated['first_name'] ?? '').' '.($validated['last_name'] ?? '')),
                    'email' => $validated['email'] ?? $doctor->user->email,
                    'mobile' => $validated['phone'] ?? $doctor->user->mobile,
                ]);
            }

            DoctorService::where('doctor_id', $doctor->id)->delete();
            if ($request->filled('services')) {
                foreach (array_filter(array_map('trim', explode(',', $request->services))) as $service) {
                    DoctorService::create(['doctor_id' => $doctor->id, 'service' => $service]);
                }
            }

            DoctorSpecialization::where('doctor_id', $doctor->id)->delete();
            if ($request->filled('specializations')) {
                foreach (array_filter(array_map('trim', explode(',', $request->specializations))) as $specialization) {
                    DoctorSpecialization::create(['doctor_id' => $doctor->id, 'specialization' => $specialization]);
                }
            }

            DoctorEducation::where('doctor_id', $doctor->id)->delete();
            foreach ($request->education_degree ?? [] as $index => $degree) {
                $college = $request->education_college[$index] ?? null;
                $year = $request->education_year[$index] ?? null;
                if ($degree || $college || $year) {
                    DoctorEducation::create([
                        'doctor_id' => $doctor->id,
                        'degree' => $degree,
                        'college' => $college,
                        'year_of_completion' => $year,
                    ]);
                }
            }

            DoctorExperience::where('doctor_id', $doctor->id)->delete();
            foreach ($request->experience_hospital ?? [] as $index => $hospital) {
                $from = $request->experience_from[$index] ?? null;
                $to = $request->experience_to[$index] ?? null;
                $designation = $request->experience_designation[$index] ?? null;
                if ($hospital || $from || $to || $designation) {
                    DoctorExperience::create([
                        'doctor_id' => $doctor->id,
                        'hospital_name' => $hospital,
                        'from' => $from,
                        'to' => $to,
                        'designation' => $designation,
                    ]);
                }
            }

            DoctorAward::where('doctor_id', $doctor->id)->delete();
            foreach ($request->award_name ?? [] as $index => $award) {
                $year = $request->award_year[$index] ?? null;
                if ($award || $year) {
                    DoctorAward::create(['doctor_id' => $doctor->id, 'award' => $award, 'year' => $year]);
                }
            }

            DoctorMembership::where('doctor_id', $doctor->id)->delete();
            foreach ($request->membership_name ?? [] as $membership) {
                if ($membership) {
                    DoctorMembership::create(['doctor_id' => $doctor->id, 'membership' => $membership]);
                }
            }

            DoctorRegistration::where('doctor_id', $doctor->id)->delete();
            foreach ($request->registration_name ?? [] as $index => $registration) {
                $year = $request->registration_year[$index] ?? null;
                if ($registration || $year) {
                    DoctorRegistration::create(['doctor_id' => $doctor->id, 'registration' => $registration, 'year' => $year]);
                }
            }

            if ($request->hasFile('clinic_images')) {
                foreach ($request->file('clinic_images') as $image) {
                    $path = $image->store('doctor_clinic_images', 'public');
                    DoctorClinicImage::create(['doctor_id' => $doctor->id, 'image' => $path]);
                }
            }

            if ($newImagePath && $oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
            }
        });

        return redirect()
            ->route('doctor.profile_settings')
            ->with('success', 'Profile updated successfully.');
    }

    public function my_patients()
    {
        $doctor = Doctor::with(['specialty', 'section'])->where('user_id', Auth::id())->first();
        if (! $doctor) {
            return redirect()->route('profile.edit')
                ->with('error', 'Doctor profile is not set up for this account.');
        }

        $patients = Appointment::with('patient.user')
            ->where('doctor_id', $doctor->id)
            ->latest('appointment_date')
            ->get()
            ->pluck('patient')
            ->filter()
            ->unique('id')
            ->values();

        return view('doctor.my_patients', compact('patients', 'doctor'));
    }

    public function schedule_timings()
    {
        return view('doctor.schedule_timings');
    }

    public function acceptAppointment($id)
    {
        $doctor = Doctor::where('user_id', Auth::id())->firstOrFail();
        $appointment = Appointment::where('doctor_id', $doctor->id)->findOrFail($id);
        $appointment->update(['status' => 'approved']);

        return back()->with('success', 'Appointment approved.');
    }

    public function cancelAppointmentDoctor($id)
    {
        $doctor = Doctor::where('user_id', Auth::id())->firstOrFail();
        $appointment = Appointment::where('doctor_id', $doctor->id)->findOrFail($id);
        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', 'Appointment cancelled.');
    }

    public function rejectAppointment($id)
    {
        return $this->cancelAppointmentDoctor($id);
    }











public function deleteClinicImage($id)
{
    $image = DoctorClinicImage::findOrFail($id);

    // حذف من storage (بلا exists)
    if ($image->image) {
        Storage::disk('public')->delete($image->image);
    }

    // حذف من DB
    $image->delete();

    return back()->with('success', 'Image deleted successfully');
}

}
