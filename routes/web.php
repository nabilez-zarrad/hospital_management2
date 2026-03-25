<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminAppointmentsController;
use App\Http\Controllers\AdminDoctorsController;
use App\Http\Controllers\AdminPatientsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
// Public pages
Route::get('/', [UserController::class, 'Index'])->name('index');







// Admin (dashboard + CRUD)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('doctors', AdminDoctorsController::class)->only(['index', 'show', 'destroy']);
    Route::resource('patients', AdminPatientsController::class)->only(['index', 'show', 'destroy']);
    Route::resource('appointments', AdminAppointmentsController::class)->except(['create', 'store']);
});
// Extra admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/add-doctor', [AdminController::class, 'createDoctor'])->name('add.doctor');
    Route::post('/add-doctor', [AdminController::class, 'storeDoctor'])->name('store.doctor');
});







// Doctor Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])
        ->name('doctor.dashboard');
});

// Public doctor listing & search
Route::get('/doctors', [UserController::class, 'doctors'])->name('doctors');
Route::get('/doctor/{id}', [UserController::class, 'doctorProfile'])->name('doctor.profile');
Route::get('/search-doctors', [UserController::class, 'searchDoctors'])->name('search.doctors');








// Patient Dashboard (اختياري)
Route::middleware('auth')->group(function () {
    Route::get('/patient/dashboard', [UserController::class, 'patientDashboard'])
        ->name('patient.dashboard');
});



// Authenticated dashboard
Route::get('/dashboard', [UserController::class, 'Dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authenticated user & doctor routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Patient side: appointments with doctors
    Route::post('/book-appointment', [UserController::class, 'bookAppointment'])->name('book.appointment');
    Route::get('/my-appointments', [UserController::class, 'myAppointments'])->name('my.appointments');
    Route::delete('/appointment/{id}', [UserController::class, 'cancelAppointment'])->name('cancel.appointment');

    // Doctor side: appointments management
    Route::get('/doctor/appointments', [DoctorController::class, 'appointments'])->name('doctor.appointments');
    Route::get('/doctor/profile_settings', [DoctorController::class, 'profile_settings'])->name('doctor.profile_settings');
    Route::get('/doctor/my_patients', [DoctorController::class, 'my_patients'])->name('doctor.my_patients');
    Route::get('/doctor/schedule_timings', [DoctorController::class, 'schedule_timings'])->name('doctor.schedule_timings');

    Route::post('/appointment/{id}/accept', [DoctorController::class, 'acceptAppointment'])->name('appointment.accept');
    Route::post('/appointment/{id}/cancel', [DoctorController::class, 'cancelAppointmentDoctor'])->name('appointment.cancel');

    });





 // Patient NAVBAR
Route::get('/patient/search', [UserController::class, 'search'])->name('patient.search')->middleware('auth');
// Route::post('/pation/booking', [UserController::class, 'booking'])->name('patient.booking');
Route::get('/booking/{id}', [UserController::class, 'booking'])->name('patient.booking');




Route::get('/patient/checkout', [UserController::class, 'checkout'])->name('patient.checkout');
Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/booking-success', function () {
    return view('patient.booking-success');})->name('booking.success');

Route::get('/booking-success/{id}', function ($id) {
    $booking = \App\Models\Booking::findOrFail($id);
    return view('patient.booking-success', compact('booking'));})->name('booking.success');




Route::get('/patient/favourites', [UserController::class, 'favourites'])->name('patient.favourites');
Route::post('/patient/favourites/toggle/{doctorId}', [UserController::class, 'toggleFavourite'])->name('patient.favourites.toggle');


Route::get('/doctor/profile/{id}', [UserController::class, 'doctorProfile'])->name('doctor.profile');


Route::middleware(['auth'])->group(function () {
    Route::get('/doctor/profile-settings', [DoctorController::class, 'profile_settings'])
        ->name('doctor.profile_settings');

    Route::post('/doctor/profile-settings', [DoctorController::class, 'updateProfileSettings'])
        ->name('doctor.profile.settings.update');
});


require __DIR__ . '/auth.php';

