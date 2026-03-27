<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'payment_method' => 'required|in:paypal,card,credit_card',
            'booking_date' => 'required|date',
            'booking_time' => 'required|date_format:H:i',
            'terms_accept' => 'accepted',
        ]);

        $patient = Patient::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone' => $validated['phone'],
            ]
        );

        $doctor = Doctor::findOrFail($validated['doctor_id']);
        $method = $validated['payment_method'] === 'credit_card' ? 'card' : $validated['payment_method'];

        $consultingFee = $doctor->is_free ? 0 : (float) ($doctor->price ?? 0);
        $bookingFee = 5;
        $videoFee = 0;
        $total = $consultingFee + $bookingFee + $videoFee;

        $booking = DB::transaction(function () use ($patient, $doctor, $validated, $method, $consultingFee, $bookingFee, $videoFee, $total) {
            $booking = Booking::create([
                'patient_id' => $patient->id,
                'doctor_id' => $doctor->id,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'payment_method' => $method,
                'booking_date' => $validated['booking_date'],
                'booking_time' => $validated['booking_time'],
            ]);

            Appointment::create([
                'patient_id' => $patient->id,
                'doctor_id' => $doctor->id,
                'appointment_date' => $validated['booking_date'],
                'appointment_time' => $validated['booking_time'],
                'consulting_fee' => $consultingFee,
                'booking_fee' => $bookingFee,
                'video_fee' => $videoFee,
                'total' => $total,
                'status' => 'pending',
            ]);

            return $booking;
        });

        return redirect()->route('booking.success', $booking->id)
            ->with('success', 'Your booking has been confirmed.');
    }
}
