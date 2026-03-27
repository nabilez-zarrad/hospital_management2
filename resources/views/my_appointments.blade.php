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
</head>
<body>
<div class="main-wrapper">
    @include('patient.header')

    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <h2 class="breadcrumb-title">My Appointments</h2>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('patient.sidbar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0">
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
                                        <tr>
                                            <td>Dr. {{ $appointment->doctor?->full_name ?? 'Doctor profile in progress' }}</td>
                                            <td>{{ $appointment->doctor?->specialty_label ?? 'General Physician' }}</td>
                                            <td>{{ $appointment->appointment_date?->format('Y-m-d') ?? 'Date will be confirmed' }}</td>
                                            <td>{{ $appointment->appointment_time ? \Illuminate\Support\Carbon::parse($appointment->appointment_time)->format('H:i') : 'Time will be confirmed' }}</td>
                                            <td>{{ ucfirst($appointment->status ?? 'pending') }}</td>
                                            <td>${{ number_format((float) $appointment->total, 2) }}</td>
                                            <td>
                                                @if(($appointment->status ?? '') !== 'cancelled')
                                                    <form action="{{ route('cancel.appointment', $appointment->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" type="submit">Cancel</button>
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
