<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Checkout</title>
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
            <h2 class="breadcrumb-title">Checkout</h2>
        </div>
    </div>

    <div class="content">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-7 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('checkout.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                <input type="hidden" name="booking_date" value="{{ $date }}">
                                <input type="hidden" name="booking_time" value="{{ $time }}">

                                <h4 class="card-title">Personal Information</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input name="first_name" value="{{ old('first_name', $patient->first_name ?? str((string) auth()->user()->name)->before(' ')) }}" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input name="last_name" value="{{ old('last_name', $patient->last_name ?? str((string) auth()->user()->name)->after(' ')) }}" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control" type="email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input name="phone" value="{{ old('phone', $patient->phone ?? auth()->user()->mobile ?? '') }}" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="card-title mt-3">Payment Method</h4>
                                <div class="payment-list">
                                    <label class="payment-radio">
                                        <input type="radio" name="payment_method" value="paypal" @checked(old('payment_method', 'paypal') === 'paypal')>
                                        <span class="checkmark"></span>
                                        Paypal
                                    </label>
                                </div>
                                <div class="payment-list">
                                    <label class="payment-radio">
                                        <input type="radio" name="payment_method" value="credit_card" @checked(old('payment_method') === 'credit_card')>
                                        <span class="checkmark"></span>
                                        Credit Card
                                    </label>
                                </div>

                                <div class="terms-accept mt-3">
                                    <label class="custom-checkbox">
                                        <input name="terms_accept" type="checkbox" value="1" @checked(old('terms_accept'))>
                                        <span class="checkmark"></span>
                                        I have read and accept Terms & Conditions
                                    </label>
                                </div>

                                <div class="submit-section mt-4">
                                    <button type="submit" class="btn btn-primary submit-btn">Confirm and Pay</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 col-lg-4">
                    <div class="card booking-card">
                        <div class="card-header"><h4 class="card-title">Booking Summary</h4></div>
                        <div class="card-body">
                            <div class="booking-doc-info">
                                <a href="{{ route('doctor.profile', $doctor->id) }}" class="booking-doc-img">
                                    <img src="{{ $doctor->profile_image_url }}" alt="Doctor">
                                </a>
                                <div class="booking-info">
                                    <h4>Dr. {{ $doctor->full_name }}</h4>
                                    <div class="clinic-details">
                                        <p class="doc-location"><i class="fas fa-map-marker-alt"></i> {{ $doctor->location_label }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-summary">
                                <ul class="booking-date">
                                    <li>Date <span>{{ $date }}</span></li>
                                    <li>Time <span>{{ $time }}</span></li>
                                </ul>
                                <ul class="booking-fee">
                                    <li>Consulting Fee <span>{{ $doctor->is_free ? '$0.00' : '$' . number_format((float) $doctor->price, 2) }}</span></li>
                                    <li>Booking Fee <span>$5.00</span></li>
                                </ul>
                                @php
                                    $total = ($doctor->is_free ? 0 : (float) $doctor->price) + 5;
                                @endphp
                                <div class="booking-total">
                                    <ul class="booking-total-list">
                                        <li><span>Total</span><span class="total-cost">${{ number_format($total, 2) }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
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
