<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Doctor Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link href="{{ asset('front-end/assets/img/favicon.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/style.css') }}">
</head>
<body>
<div class="main-wrapper">
    @include('doctor.header')

    <div class="breadcrumb-bar">
        <div class="container-fluid"><h2 class="breadcrumb-title">Hello Dr. {{ $doctor->full_name }}</h2></div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('doctor.sidbar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="row mb-4">
                        <div class="col-md-4"><div class="card"><div class="card-body"><h6>Total Patients</h6><h3>{{ $patientsCount }}</h3></div></div></div>
                        <div class="col-md-4"><div class="card"><div class="card-body"><h6>Today Appointments</h6><h3>{{ $todayAppointmentsCount }}</h3></div></div></div>
                        <div class="col-md-4"><div class="card"><div class="card-body"><h6>Total Appointments</h6><h3>{{ $totalAppointmentsCount }}</h3></div></div></div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Recent Appointments</h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Patient</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($appointments as $appointment)
                                        <tr>
                                            <td>{{ $appointment->patient?->full_name ?? 'Patient profile in progress' }}</td>
                                            <td>{{ $appointment->appointment_date?->format('Y-m-d') ?? 'Date will be confirmed' }}</td>
                                            <td>{{ $appointment->appointment_time ? \Illuminate\Support\Carbon::parse($appointment->appointment_time)->format('H:i') : 'Time will be confirmed' }}</td>
                                            <td>{{ ucfirst($appointment->status) }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" class="text-center text-muted">No appointments found.</td></tr>
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
