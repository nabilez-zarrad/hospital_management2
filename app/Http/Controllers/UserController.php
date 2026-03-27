<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\PatientFavourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function Dashboard()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        return match (Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'doctor' => redirect()->route('doctor.dashboard'),
            default => redirect()->route('patient.dashboard'),
        };
    }

    public function patientDashboard()
    {
        $patient = $this->resolvePatient();
        if (! $patient) {
            return redirect()->route('profile.edit')->with('error', 'Please complete your patient profile first.');
        }

        $appointments = Appointment::with(['doctor.section', 'doctor.specialty'])
            ->where('patient_id', $patient->id)
            ->latest('appointment_date')
            ->latest('appointment_time')
            ->take(10)
            ->get();

        return view('patient.dashboard', [
            'patient' => $patient,
            'appointments' => $appointments,
            'favouritesCount' => $patient->favourites()->count(),
        ]);
    }

    public function Index()
    {
        $doctors = Doctor::with(['section', 'specialty'])->latest()->take(8)->get();

        return view('index', compact('doctors'));
    }

    public function doctors(Request $request)
    {
        $doctors = $this->doctorQuery($request)->latest()->get();

        return view('doctors', ['medecins' => $doctors]);
    }

    public function searchDoctors(Request $request)
    {
        $doctors = $this->doctorQuery($request)->latest()->get();

        return view('doctors', ['medecins' => $doctors]);
    }

    public function search(Request $request)
    {
        $doctors = $this->doctorQuery($request)->latest()->get();

        return view('patient.searchDoctor', compact('doctors'));
    }

    public function booking($id)
    {
        $doctor = Doctor::with(['section', 'specialty'])->findOrFail($id);

        return view('patient.booking', [
            'doctor' => $doctor,
            'selectedDate' => request('date', now()->toDateString()),
            'selectedTime' => request('time', '09:00'),
        ]);
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => ['required', 'exists:doctors,id'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
        ]);

        $doctor = Doctor::findOrFail($validated['doctor_id']);
        $patient = $this->resolvePatient();

        if (! $patient) {
            return redirect()->route('profile.edit')->with('error', 'Please complete your patient profile first.');
        }

        return view('patient.checkout', [
            'doctor' => $doctor,
            'patient' => $patient,
            'date' => $validated['date'],
            'time' => $validated['time'],
        ]);
    }

    public function favourites()
    {
        $patient = $this->resolvePatient();
        if (! $patient) {
            return redirect()->route('profile.edit')->with('error', 'Patient profile not found.');
        }

        $favouriteDoctors = $patient->favouriteDoctors()
            ->with(['section', 'specialty'])
            ->latest('patient_favourites.created_at')
            ->get();

        return view('patient.favourites', compact('patient', 'favouriteDoctors'));
    }

    public function toggleFavourite($doctorId)
    {
        $patient = $this->resolvePatient();
        if (! $patient) {
            return back()->with('error', 'Patient profile not found.');
        }

        $doctor = Doctor::findOrFail($doctorId);

        $exists = PatientFavourite::where('patient_id', $patient->id)
            ->where('doctor_id', $doctor->id)
            ->first();

        if ($exists) {
            $exists->delete();

            return back()->with('success', 'Doctor removed from favourites.');
        }

        PatientFavourite::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
        ]);

        return back()->with('success', 'Doctor added to favourites.');
    }

    public function bookAppointment(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => ['required', 'exists:doctors,id'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required', 'date_format:H:i'],
        ]);

        $patient = $this->resolvePatient();
        if (! $patient) {
            return back()->with('error', 'Patient profile not found.');
        }

        $doctor = Doctor::findOrFail($validated['doctor_id']);
        $consultingFee = $doctor->is_free ? 0 : (float) ($doctor->price ?? 0);
        $bookingFee = 5;
        $videoFee = 0;

        Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'consulting_fee' => $consultingFee,
            'booking_fee' => $bookingFee,
            'video_fee' => $videoFee,
            'total' => $consultingFee + $bookingFee + $videoFee,
            'status' => 'pending',
        ]);

        return redirect()->route('my.appointments')->with('success', 'Appointment booked successfully.');
    }

    public function myAppointments()
    {
        $patient = $this->resolvePatient();
        if (! $patient) {
            return redirect()->route('profile.edit')->with('error', 'Patient profile not found.');
        }

        // Backfill old bookings into appointments so legacy booked records appear here.
        $patient->bookings()->with('doctor')->get()->each(function ($booking) use ($patient) {
            $consultingFee = $booking->doctor?->is_free ? 0 : (float) ($booking->doctor?->price ?? 0);
            $bookingFee = 5;
            $videoFee = 0;

            Appointment::firstOrCreate(
                [
                    'patient_id' => $patient->id,
                    'doctor_id' => $booking->doctor_id,
                    'appointment_date' => $booking->booking_date,
                    'appointment_time' => $booking->booking_time,
                ],
                [
                    'consulting_fee' => $consultingFee,
                    'booking_fee' => $bookingFee,
                    'video_fee' => $videoFee,
                    'total' => $consultingFee + $bookingFee + $videoFee,
                    'status' => 'pending',
                ]
            );
        });

        $appointments = Appointment::with('doctor')
            ->where('patient_id', $patient->id)
            ->latest('appointment_date')
            ->latest('appointment_time')
            ->get();

        return view('my_appointments', compact('appointments'));
    }

    public function cancelAppointment($id)
    {
        $patient = $this->resolvePatient();
        if (! $patient) {
            return redirect()->route('profile.edit')->with('error', 'Patient profile not found.');
        }

        $appointment = Appointment::where('patient_id', $patient->id)->findOrFail($id);
        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', 'Appointment cancelled.');
    }

    public function doctorProfile($id)
    {
        $doctor = Doctor::with([
            'section',
            'specialty',
            'clinicImages',
            'services',
            'specializations',
            'educations',
            'experiences',
            'awards',
        ])->findOrFail($id);

        $patient = $this->resolvePatient();
        $isFavourite = false;

        if ($patient) {
            $isFavourite = PatientFavourite::where('patient_id', $patient->id)
                ->where('doctor_id', $doctor->id)
                ->exists();
        }

        return view('patient.doctor-profile', compact('doctor', 'isFavourite'));
    }

    private function resolvePatient(): ?Patient
    {
        if (! Auth::check()) {
            return null;
        }

        $user = Auth::user();

        if (in_array($user->role, ['admin', 'doctor'], true)) {
            return null;
        }

        return Patient::with('user')->firstOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => (string) str($user->name)->before(' '),
                'last_name' => (string) str($user->name)->after(' '),
                'phone' => $user->mobile,
            ]
        );
    }

    private function doctorQuery(Request $request)
    {
        $query = Doctor::query()->with(['section', 'specialty']);

        if ($request->filled('name') || $request->filled('search')) {
            $raw = $request->input('name', $request->input('search'));
            $term = '%' . trim((string) $raw) . '%';

            $query->where(function ($q) use ($term) {
                $q->where('first_name', 'like', $term)
                    ->orWhere('last_name', 'like', $term)
                    ->orWhere('speciality', 'like', $term);
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', (string) $request->string('gender'));
        }

        if ($request->filled('speciality')) {
            $speciality = trim((string) $request->string('speciality'));
            $query->where(function ($q) use ($speciality) {
                $q->where('speciality', 'like', '%'.$speciality.'%')
                    ->orWhereHas('specialty', function ($specialtyQuery) use ($speciality) {
                        $specialtyQuery->where('name', 'like', '%'.$speciality.'%');
                    });
            });
        }

        return $query;
    }
}
