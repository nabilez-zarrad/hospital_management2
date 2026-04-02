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
    @include('components.premium-dashboard-styles')
    <style>
        .booking-shell {
            max-width: 1120px;
            margin: 0 auto;
        }

        .booking-card {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .booking-card .card-body {
            padding: 20px;
        }

        .booking-doc-info {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fbff;
            margin-bottom: 18px;
        }

        .booking-doc-img img {
            width: 78px;
            height: 78px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid #dbe3ef;
        }

        .booking-info h4 {
            margin-bottom: 2px;
            font-size: 23px;
            font-weight: 700;
            color: #0f172a;
        }

        .booking-info p {
            margin-bottom: 0;
            color: #64748b !important;
            font-size: 14px;
        }

        .booking-card .form-control {
            height: 46px;
            border-radius: 10px;
            border-color: #dbe3ef;
        }

        .booking-card label {
            font-weight: 600;
            color: #334155;
            margin-bottom: 7px;
        }

        .booking-card .btn-primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border: 0;
            border-radius: 10px;
            font-weight: 600;
            padding: 10px 18px;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.25);
        }

        .booking-card .btn-primary:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    @include('patient.header')

    <div class="content">
        <div class="container-fluid booking-shell">
            <div class="premium-hero mb-3">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>Booking</h2>
                        <p>Select your preferred date and time to continue checkout.</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('patient.search') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i>Back To Search
                        </a>
                    </div>
                </div>
            </div>

            <div class="card booking-card">
                <div class="card-body">
                    <div class="booking-doc-info">
                        <a href="{{ route('doctor.profile', $doctor->id) }}" class="booking-doc-img">
                            <img src="{{ $doctor->profile_image_url }}" alt="Doctor Image">
                        </a>
                        <div class="booking-info">
                            <h4>Dr. {{ $doctor->full_name }}</h4>
                            <p>{{ $doctor->specialty_label }}</p>
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
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-credit-card mr-1"></i>Proceed to Checkout
                            </button>
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
