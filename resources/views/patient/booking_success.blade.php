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
    @include('components.premium-dashboard-styles')
    <style>
        .success-shell {
            max-width: 760px;
            margin: 0 auto;
        }

        .success-card {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 12px 26px rgba(15, 23, 42, 0.09);
            overflow: hidden;
        }

        .success-card .card-body {
            padding: 18px;
        }

        .success-icon {
            width: 56px;
            height: 56px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #fff;
            background: linear-gradient(135deg, #10b981, #14b8a6);
            box-shadow: 0 12px 24px rgba(16, 185, 129, 0.28);
        }

        .success-title {
            margin: 12px 0 6px;
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
        }

        .success-subtitle {
            color: #64748b;
            margin-bottom: 12px;
            font-size: 18px;
        }

        .success-summary {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fbff;
            padding: 10px 12px;
            margin-bottom: 14px;
        }

        .success-summary-item {
            display: flex;
            justify-content: space-between;
            font-size: 17px;
            margin-bottom: 6px;
            color: #334155;
        }

        .success-summary-item:last-child {
            margin-bottom: 0;
        }

        .success-actions .btn {
            border-radius: 10px;
            font-weight: 600;
            padding: 8px 14px;
            font-size: 14px;
        }

        .success-actions .btn + .btn {
            margin-left: 10px;
        }

        @media print {
            .premium-hero,
            .success-actions,
            .header {
                display: none !important;
            }

            .main-wrapper {
                padding-top: 0 !important;
            }

            .success-shell {
                max-width: 100%;
            }

            .success-card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    @include('patient.header')

    <div class="content">
        <div class="container-fluid success-shell">
            <div class="premium-hero mb-3">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>Booking Confirmed</h2>
                        <p>Your appointment has been saved successfully.</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('patient.dashboard') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-home mr-1"></i>Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <div class="card success-card">
                <div class="card-body text-center">
                    <span class="success-icon"><i class="fas fa-check"></i></span>
                    <h3 class="success-title">Appointment Booked Successfully</h3>
                    <p class="success-subtitle">Thank you. Your booking request is now confirmed.</p>

                    <div class="success-summary text-left">
                        <div class="success-summary-item">
                            <span>Doctor</span>
                            <strong>
                                @if (!empty($booking))
                                    Dr. {{ trim(($booking->doctor->first_name ?? '') . ' ' . ($booking->doctor->last_name ?? '')) ?: 'Doctor' }}
                                @else
                                    -
                                @endif
                            </strong>
                        </div>
                        <div class="success-summary-item">
                            <span>Date</span>
                            <strong>{{ !empty($booking) ? ($booking->booking_date?->format('Y-m-d') ?? $booking->booking_date) : '-' }}</strong>
                        </div>
                        <div class="success-summary-item">
                            <span>Time</span>
                            <strong>{{ !empty($booking) && $booking->booking_time ? \Illuminate\Support\Carbon::parse($booking->booking_time)->format('H:i') : '-' }}</strong>
                        </div>
                    </div>

                    <div class="success-actions">
                        <a href="{{ route('my.appointments') }}" class="btn btn-primary">
                            <i class="fas fa-calendar-check mr-1"></i>Go To My Appointments
                        </a>
                        <a href="{{ route('patient.search') }}" class="btn btn-outline-primary">
                            <i class="fas fa-search mr-1"></i>Find Another Doctor
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
