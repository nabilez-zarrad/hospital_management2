<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Booking Success</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link href="{{ asset('front-end/assets/img/favicon.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/style.css') }}">
</head>
<body>
<div class="main-wrapper">
    @include('patient.header')
    <div class="content success-page-cont">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card success-card">
                        <div class="card-body">
                            <div class="success-cont">
                                <i class="fas fa-check"></i>
                                <h3>Appointment booked successfully</h3>
                                <p>
                                    @if (!empty($booking))
                                        Dr. {{ trim(($booking->doctor->first_name ?? '') . ' ' . ($booking->doctor->last_name ?? '')) ?: 'Doctor' }}<br>
                                        {{ $booking->booking_date?->format('Y-m-d') ?? $booking->booking_date }} at {{ $booking->booking_time ? \Illuminate\Support\Carbon::parse($booking->booking_time)->format('H:i') : 'Time will be confirmed' }}
                                    @else
                                        Your booking was completed successfully.
                                    @endif
                                </p>
                                <a href="{{ route('my.appointments') }}" class="btn btn-primary">Go to My Appointments</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
