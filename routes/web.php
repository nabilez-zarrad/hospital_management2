<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public pages
Route::get('/', [UserController::class, 'Index'])->name('index');

// Dashboard
Route::get('/dashboard', [UserController::class, 'Dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Patient
    Route::post('/book-appointment', [UserController::class, 'bookAppointment'])->name('book.appointment');
    Route::get('/my-appointments', [UserController::class, 'myAppointments'])->name('my.appointments');
    Route::delete('/appointment/{id}', [UserController::class, 'cancelAppointment'])->name('cancel.appointment');

    // Doctor
    Route::get('/doctor/appointments', [DoctorController::class, 'appointments'])->name('doctor.appointments');
    Route::get('/doctor/profile-settings', [DoctorController::class, 'doctorProfileSettings'])->name('doctor.profile.settings');
    Route::get('/doctor/my-patients', [DoctorController::class, 'myPatients'])->name('doctor.my.patients');
    Route::get('/doctor/schedule-timings', [DoctorController::class, 'scheduleTimings'])->name('doctor.schedule.timings');

    Route::post('/appointment/{id}/accept', [DoctorController::class, 'acceptAppointment'])->name('appointment.accept');
    Route::post('/appointment/{id}/cancel', [DoctorController::class, 'cancelAppointmentDoctor'])->name('appointment.cancel');
});

// Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/add-doctor', [AdminController::class, 'createDoctor'])->name('add.doctor');
    Route::post('/add-doctor', [AdminController::class, 'storeDoctor'])->name('store.doctor');
});

// Public doctors
Route::get('/doctors', [UserController::class, 'doctors'])->name('doctors');
Route::get('/doctor/{id}', [UserController::class, 'doctorProfile'])->name('doctor.profile');
Route::get('/search-doctors', [UserController::class, 'searchDoctors'])->name('search.doctors');

require __DIR__ . '/auth.php';