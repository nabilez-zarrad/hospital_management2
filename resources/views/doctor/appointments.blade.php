<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Doctor Appointments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link href="{{ asset('front-end/assets/img/favicon.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/style.css') }}">
    @include('components.premium-dashboard-styles')
    <style>
        .appointments-shell {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #fff;
            overflow: hidden;
        }

        .appointment-item {
            padding: 16px;
            border-bottom: 1px solid #edf2f7;
        }

        .appointment-item:last-child {
            border-bottom: 0;
        }

        .appointment-patient {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .appointment-patient img {
            width: 66px;
            height: 66px;
            border-radius: 12px;
            object-fit: cover;
            border: 1px solid #dbe5f2;
        }

        .appointment-patient h5 {
            font-size: 18px;
            margin-bottom: 5px;
            color: #0f172a;
        }

        .appointment-date {
            font-size: 12px;
            color: #64748b;
            margin-top: 3px;
        }

        .appointment-meta {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .appointment-meta li {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 4px;
        }

        .appointment-meta i {
            width: 16px;
            color: #475569;
            margin-right: 4px;
        }

        .appointment-action {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
            align-items: center;
        }

        .appointment-action .btn {
            border-radius: 9px;
            font-size: 12px;
            font-weight: 700;
            border: 0;
            padding: 8px 12px;
        }

        .appointment-action .btn-success {
            background: #dcfce7;
            color: #15803d;
        }

        .appointment-action .btn-danger {
            background: #fee2e2;
            color: #dc2626;
        }

        @media (max-width: 767px) {
            .appointment-action {
                justify-content: flex-start;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    @include('doctor.header')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('doctor.sidbar')

                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="premium-hero d-flex align-items-center justify-content-between flex-wrap">
                        <div class="mb-2 mb-md-0">
                            <h2>Appointments</h2>
                            <p>Manage incoming patient bookings quickly and clearly.</p>
                        </div>
                        <span class="badge badge-light px-3 py-2" style="border-radius:999px;font-weight:700;">
                            {{ $appointments->count() }} Total
                        </span>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success border-0" style="border-radius:12px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card premium-card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Appointments List</h4>
                        </div>
                        <div class="card-body">
                            <div class="appointments-shell">
                                @forelse($appointments as $appointment)
                                    <div class="appointment-item">
                                        <div class="row align-items-center">
                                            <div class="col-lg-8">
                                                <div class="appointment-patient">
                                                    <img src="{{ $appointment->patient?->image ? asset('storage/' . $appointment->patient->image) : asset('front-end/assets/img/patients/patient.jpg') }}" alt="Patient">
                                                    <div>
                                                        <h5 class="mb-0">{{ $appointment->patient?->full_name ?? 'Patient profile in progress' }}</h5>
                                                        <div class="appointment-date">
                                                            {{ $appointment->appointment_date?->format('Y-m-d') ?? 'Date will be confirmed' }}
                                                            @if($appointment->appointment_time)
                                                                at {{ \Illuminate\Support\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                                            @endif
                                                        </div>
                                                        <ul class="appointment-meta mt-2">
                                                            <li><i class="fas fa-map-marker-alt"></i>{{ $appointment->patient?->address ?? 'No address' }}</li>
                                                            <li><i class="fas fa-envelope"></i>{{ $appointment->patient?->email ?? 'No email' }}</li>
                                                            <li><i class="fas fa-phone"></i>{{ $appointment->patient?->phone ?? 'No phone' }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="appointment-action">
                                                    <form method="POST" action="{{ route('appointment.accept', $appointment->id) }}" class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-success" type="submit">
                                                            <i class="fas fa-check mr-1"></i>Accept
                                                        </button>
                                                    </form>

                                                    <form method="POST" action="{{ route('appointment.cancel', $appointment->id) }}" class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-danger" type="submit">
                                                            <i class="fas fa-times mr-1"></i>Cancel
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="appointment-item text-center text-muted py-4">
                                        No appointments found.
                                    </div>
                                @endforelse
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
<script src="{{ asset('front-end/assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
<script src="{{ asset('front-end/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
<script src="{{ asset('front-end/assets/js/script.js') }}"></script>
</body>
</html>
