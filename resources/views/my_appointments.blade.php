<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Appointments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link href="{{ asset('front-end/assets/img/favicon.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/style.css') }}">
    @include('components.premium-dashboard-styles')
    <style>
        .appointments-shell {
            max-width: none;
            margin: 0;
        }

        .appointments-shell .theiaStickySidebar {
            transform: none;
        }

        .appointments-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.08);
            overflow: hidden;
            background: #fff;
        }

        .appointments-card .card-body {
            padding: 12px;
        }

        .appointments-table thead th {
            background: #eff6ff;
            color: #1e3a8a;
            font-size: 13px;
            font-weight: 700;
            border-top: 0;
            padding: 10px 8px;
        }

        .appointments-table td {
            font-size: 13px;
            color: #1f2937;
            padding: 9px 8px;
            vertical-align: middle;
            border-color: #eef2f7;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .status-badge.pending { background: #fef3c7; color: #92400e; }
        .status-badge.approved { background: #dbeafe; color: #1e40af; }
        .status-badge.completed { background: #d1fae5; color: #065f46; }
        .status-badge.cancelled { background: #fee2e2; color: #991b1b; }

        .appointments-card .btn-danger {
            border-radius: 8px;
            font-size: 12px;
            padding: 5px 10px;
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    @include('patient.header')

    <div class="content">
        <div class="container-fluid appointments-shell">
            <div class="premium-hero mb-3">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>My Appointments</h2>
                        <p>Review your booking history and manage upcoming visits.</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('patient.dashboard') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i>Back To Dashboard
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                @include('patient.sidbar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card appointments-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0 appointments-table">
                                    <thead>
                                    <tr>
                                        <th>Doctor</th>
                                        <th>Speciality</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($appointments as $appointment)
                                        @php($status = strtolower((string)($appointment->status ?? 'pending')))
                                        <tr>
                                            <td>Dr. {{ $appointment->doctor?->full_name ?? '-' }}</td>
                                            <td>{{ $appointment->doctor?->specialty_label ?? 'General Physician' }}</td>
                                            <td>{{ $appointment->appointment_date?->format('Y-m-d') ?? '-' }}</td>
                                            <td>{{ $appointment->appointment_time ? \Illuminate\Support\Carbon::parse($appointment->appointment_time)->format('H:i') : '-' }}</td>
                                            <td><span class="status-badge {{ $status }}">{{ ucfirst($status) }}</span></td>
                                            <td>${{ number_format((float) $appointment->total, 2) }}</td>
                                            <td>
                                                @if($status !== 'cancelled')
                                                    <form action="{{ route('cancel.appointment', $appointment->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-times mr-1"></i>Cancel</button>
                                                    </form>
                                                @else
                                                    <span class="text-muted">Cancelled</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="7" class="text-center text-muted">No appointments yet.</td></tr>
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
