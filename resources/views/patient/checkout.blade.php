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
    @include('components.premium-dashboard-styles')
    <style>
        .checkout-shell {
            max-width: 1060px;
            margin: 0 auto;
        }

        .checkout-card {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
            overflow: hidden;
            background: #fff;
        }

        .checkout-card .card-body {
            padding: 14px;
        }

        .checkout-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 2px;
            color: #0f172a;
        }

        .section-label {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #0f172a;
        }

        .checkout-card .form-control {
            height: 40px;
            border-radius: 10px;
            border-color: #dbe3ef;
            font-size: 14px;
        }

        .checkout-card label {
            font-weight: 600;
            color: #334155;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 7px;
            font-weight: 600;
            color: #1f2937;
            font-size: 14px;
        }

        .summary-top {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 9px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fbff;
            margin-bottom: 10px;
        }

        .summary-top img {
            width: 62px;
            height: 62px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid #dbe3ef;
        }

        .summary-top h4 {
            margin-bottom: 2px;
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
        }

        .summary-top p {
            font-size: 13px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 7px;
            color: #334155;
            font-size: 14px;
        }

        .summary-total {
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
        }

        .summary-total .amount {
            color: #2563eb;
        }

        .checkout-card .btn-primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border: 0;
            border-radius: 10px;
            font-weight: 600;
            padding: 8px 14px;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.25);
            font-size: 14px;
        }

        .checkout-card .btn-primary:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    @include('patient.header')

    <div class="content">
        <div class="container-fluid checkout-shell">
            <div class="premium-hero mb-3">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="checkout-title">Checkout</h2>
                        <p>Complete your details to confirm the booking and proceed.</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('patient.booking', $doctor->id) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i>Back To Booking
                        </a>
                    </div>
                </div>
            </div>

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
                    <div class="card checkout-card">
                        <div class="card-body">
                            <form action="{{ route('checkout.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                <input type="hidden" name="booking_date" value="{{ $date }}">
                                <input type="hidden" name="booking_time" value="{{ $time }}">

                                <h4 class="section-label">Personal Information</h4>
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

                                <h4 class="section-label mt-2">Payment Method</h4>
                                <label class="payment-option">
                                    <input type="radio" name="payment_method" value="paypal" @checked(old('payment_method', 'paypal') === 'paypal')>
                                    <span>Paypal</span>
                                </label>
                                <label class="payment-option">
                                    <input type="radio" name="payment_method" value="credit_card" @checked(old('payment_method') === 'credit_card')>
                                    <span>Credit Card</span>
                                </label>

                                <div class="terms-accept mt-3">
                                    <label class="custom-checkbox">
                                        <input name="terms_accept" type="checkbox" value="1" @checked(old('terms_accept'))>
                                        <span class="checkmark"></span>
                                        I have read and accept Terms & Conditions
                                    </label>
                                </div>

                                <div class="submit-section mt-4">
                                    <button type="submit" class="btn btn-primary submit-btn">
                                        <i class="fas fa-lock mr-1"></i>Confirm and Pay
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 col-lg-4">
                    <div class="card checkout-card">
                        <div class="card-header"><h4 class="card-title mb-0">Booking Summary</h4></div>
                        <div class="card-body">
                            <div class="summary-top">
                                <a href="{{ route('doctor.profile', $doctor->id) }}">
                                    <img src="{{ $doctor->profile_image_url }}" alt="Doctor">
                                </a>
                                <div>
                                    <h4>Dr. {{ $doctor->full_name }}</h4>
                                    <p class="mb-0 text-muted"><i class="fas fa-map-marker-alt mr-1"></i>{{ $doctor->location_label }}</p>
                                </div>
                            </div>

                            <div class="summary-item"><span>Date</span><span>{{ $date }}</span></div>
                            <div class="summary-item"><span>Time</span><span>{{ $time }}</span></div>
                            <div class="summary-item"><span>Consulting Fee</span><span>{{ $doctor->is_free ? '$0.00' : '$' . number_format((float) $doctor->price, 2) }}</span></div>
                            <div class="summary-item"><span>Booking Fee</span><span>$5.00</span></div>

                            @php
                                $total = ($doctor->is_free ? 0 : (float) $doctor->price) + 5;
                            @endphp
                            <div class="summary-total">
                                <span>Total</span>
                                <span class="amount">${{ number_format($total, 2) }}</span>
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
