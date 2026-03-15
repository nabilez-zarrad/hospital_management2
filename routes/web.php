<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', [UserController::class, 'Index'])->name('index');

Route::get('/dashboard', [UserController::class,'Dashboard'] )->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth','admin')->group(function () {
   
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/doctors', [UserController::class,'doctors'])->name('doctors');
Route::get('/doctor/{id}', [UserController::class,'doctorProfile'])->name('doctor.profile');
Route::post('/book-appointment', [UserController::class,'bookAppointment'])->name('book.appointment');
Route::get('/my-appointments', [UserController::class,'myAppointments'])->name('my.appointments');
Route::delete('/appointment/{id}', [UserController::class,'cancelAppointment'])->name('cancel.appointment');
Route::get('/search-doctors', [UserController::class,'searchDoctors'])->name('search.doctors');
Route::get('/add-doctor', [AdminController::class,'createDoctor']);
Route::post('/add-doctor', [AdminController::class,'storeDoctor'])->name('store.doctor');
