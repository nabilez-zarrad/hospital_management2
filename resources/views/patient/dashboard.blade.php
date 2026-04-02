<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Patient Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link href="{{ asset('front-end/assets/img/favicon.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/style.css') }}">
    @include('components.premium-dashboard-styles')
</head>
<body>
<div class="main-wrapper">
    @include('patient.header')

    <div class="content">
        <div class="container-fluid">
            <div class="premium-hero">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>Patient Dashboard</h2>
                        <p>{{ $patient?->full_name ?? auth()->user()->name }}</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('patient.search') }}" class="btn btn-light btn-sm mr-2">
                            <i class="fas fa-search mr-1"></i>Find Doctor
                        </a>
                        <a href="{{ route('my.appointments') }}" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-calendar-check mr-1"></i>Appointments
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                @include('patient.sidbar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="row">
                        @foreach(($dashboardCards ?? []) as $card)
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="premium-stat-card">
                                    <div class="premium-stat-head">
                                        <div>
                                            <div class="premium-stat-title">{{ $card['title'] ?? '-' }}</div>
                                            <p class="premium-stat-value">{{ $card['value'] ?? 0 }}</p>
                                        </div>
                                        <span class="premium-stat-icon" style="background: {{ $card['gradient'] ?? 'linear-gradient(135deg, #0ea5e9, #2563eb)' }};">
                                            <i class="{{ $card['icon'] ?? 'fas fa-chart-line' }}"></i>
                                        </span>
                                    </div>
                                    <p class="premium-stat-foot">{{ $card['meta'] ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="card premium-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Recent Appointments</h4>
                            <a href="{{ route('my.appointments') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye mr-1"></i>View All
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive premium-table-wrap">
                                <table class="table table-hover table-center premium-table mb-0">
                                    <thead>
                                    <tr>
                                        <th>Doctor</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($appointments as $appointment)
                                        <tr>
                                            <td>Dr. {{ $appointment->doctor?->full_name ?? '-' }}</td>
                                            <td>{{ $appointment->appointment_date?->format('Y-m-d') ?? '-' }}</td>
                                            <td>{{ $appointment->appointment_time ? \Illuminate\Support\Carbon::parse($appointment->appointment_time)->format('H:i') : '-' }}</td>
                                            <td>
                                                <span class="premium-badge {{ strtolower((string) $appointment->status) }}">
                                                    {{ ucfirst((string) $appointment->status) }}
                                                </span>
                                            </td>
                                            <td>${{ number_format((float) $appointment->total, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center text-muted">No appointments yet.</td></tr>
                                    @endforelse
                                    </tbody>
                                </table>
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
