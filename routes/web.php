<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminAppointmentsController;
use App\Http\Controllers\AdminDoctorsController;
use App\Http\Controllers\AdminPatientsController;
use App\Http\Controllers\AdminSpecialtyController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilePatientController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [UserController::class, 'Index'])->name('index');

// --- Admin (role: admin only) ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('doctors', AdminDoctorsController::class)->only(['index', 'show', 'destroy']);
    Route::resource('patients', AdminPatientsController::class)->only(['index', 'show', 'destroy']);
    Route::resource('appointments', AdminAppointmentsController::class)->except(['create', 'store']);
    Route::resource('specialties', AdminSpecialtyController::class)->except(['show']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/add-doctor', [AdminController::class, 'createDoctor'])->name('add.doctor');
    Route::post('/add-doctor', [AdminController::class, 'storeDoctor'])->name('store.doctor');
});

// --- Doctor (role: doctor only) — register before public `/doctor/{id}` ---
Route::middleware(['auth', 'doctor'])->group(function () {
    Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
    Route::get('/doctor/appointments', [DoctorController::class, 'appointments'])->name('doctor.appointments');
    Route::get('/doctor/profile_settings', [DoctorController::class, 'profile_settings'])->name('doctor.profile_settings');
    Route::get('/doctor/my_patients', [DoctorController::class, 'my_patients'])->name('doctor.my_patients');
    Route::get('/doctor/schedule_timings', [DoctorController::class, 'schedule_timings'])->name('doctor.schedule_timings');
    Route::post('/appointment/{id}/accept', [DoctorController::class, 'acceptAppointment'])->name('appointment.accept');
    Route::post('/appointment/{id}/reject', [DoctorController::class, 'rejectAppointment'])->name('appointment.reject');
    Route::post('/appointment/{id}/cancel', [DoctorController::class, 'cancelAppointmentDoctor'])->name('appointment.cancel');
    Route::post('/doctor/profile-settings', [DoctorController::class, 'updateProfileSettings'])->name('doctor.profile.settings.update');
});

// --- Public doctor listing & search ---
Route::get('/doctors', [UserController::class, 'doctors'])->name('doctors');
Route::get('/doctor/{id}', [UserController::class, 'doctorProfile'])->name('doctor.profile')->whereNumber('id');
Route::get('/search-doctors', [UserController::class, 'searchDoctors'])->name('search.doctors');

// --- Patient (role: patient only) ---
Route::middleware(['auth', 'patient'])->group(function () {
    Route::get('/patient/dashboard', [UserController::class, 'patientDashboard'])->name('patient.dashboard');
    Route::get('/patient/search', [UserController::class, 'search'])->name('patient.search');
    Route::get('/patient/profile-settings', [ProfileController::class, 'edit'])->name('patient.profile.settings');
    Route::get('/booking/{id}', [UserController::class, 'booking'])->name('patient.booking');
    Route::get('/patient/checkout', [UserController::class, 'checkout'])->name('patient.checkout');
    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/patient/favourites', [UserController::class, 'favourites'])->name('patient.favourites');
    Route::post('/patient/favourites/toggle/{doctorId}', [UserController::class, 'toggleFavourite'])->name('patient.favourites.toggle');
    Route::post('/book-appointment', [UserController::class, 'bookAppointment'])->name('book.appointment');
    Route::get('/my-appointments', [UserController::class, 'myAppointments'])->name('my.appointments');
    Route::delete('/appointment/{id}', [UserController::class, 'cancelAppointment'])->name('cancel.appointment');

    Route::get('/booking-success/{id?}', function (?string $id = null) {
        $booking = $id !== null ? \App\Models\Booking::with('doctor')->findOrFail($id) : null;

        return view('patient.booking_success', compact('booking'));
    })->name('booking.success');

});

// --- Hub: sends user to the right dashboard by role ---
Route::get('/dashboard', [UserController::class, 'Dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// --- Profile (any authenticated role) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::delete('/doctor/clinic-image/{id}', [DoctorController::class, 'deleteClinicImage'])
    ->name('clinic.image.delete');
require __DIR__.'/auth.php';
