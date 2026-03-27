<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Book Appointment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link href="{{ asset('front-end/assets/img/favicon.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/style.css') }}">
</head>
<body>
<div class="main-wrapper">
    @include('patient.header')

    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <h2 class="breadcrumb-title">Booking</h2>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="booking-doc-info mb-4">
                        <a href="{{ route('doctor.profile', $doctor->id) }}" class="booking-doc-img">
                            <img src="{{ $doctor->profile_image_url }}" alt="Doctor Image">
                        </a>
                        <div class="booking-info">
                            <h4>Dr. {{ $doctor->full_name }}</h4>
                            <p class="text-muted mb-0">{{ $doctor->specialty_label }}</p>
                        </div>
                    </div>

                    <form method="GET" action="{{ route('patient.checkout') }}">
                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="date" class="form-control" value="{{ old('date', $selectedDate ?? now()->toDateString()) }}" min="{{ now()->toDateString() }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Time</label>
                                    <select name="time" class="form-control" required>
                                        @foreach(['09:00','10:00','11:00','14:00','15:00','16:00'] as $slot)
                                            <option value="{{ $slot }}" @selected(old('time', $selectedTime ?? '09:00') === $slot)>{{ $slot }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section proceed-btn text-right">
                            <button class="btn btn-primary" type="submit">Proceed to Checkout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('front-end/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('front-end/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('front-end/assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
