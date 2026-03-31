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
</head>
<body>
<div class="main-wrapper">
    @include('doctor.header')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('doctor.sidbar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Appointments</h4>






                            <div class="appointments">

    @forelse($appointments as $appointment)
        <div class="appointment-list">
            <div class="profile-info-widget">

                
                <a href="#" class="booking-doc-img">
                    <img src="{{ $appointment->patient?->image ? asset('storage/' . $appointment->patient->image)  : 'no image' }}"  alt="User Image">
               </a>
                <div class="profile-det-info">
                    <h3>{{ $appointment->patient?->full_name ?? 'Patient profile in progress' }}</h3>
                    <div class="patient-details">
                        <h5><i class="far fa-clock"></i>  {{ $appointment->appointment_date?->format('Y-m-d') ?? 'Date will be confirmed' }}</h5>
                        <h5><i class="fas fa-map-marker-alt"></i>  {{ $appointment->patient?->address ?? 'No address' }}</h5>
                        <h5><i class="fas fa-envelope"></i> {{ $appointment->patient?->email ?? 'No email' }}</h5>
                        <h5 class="mb-0"><i class="fas fa-phone"></i> {{ $appointment->patient?->phone ?? 'No phone' }}</h5>
                    </div>
                </div>
            </div>
            <div class="appointment-action">

                <!-- Accept -->
                <form method="POST" action="{{ route('appointment.accept', $appointment->id) }}" class="d-inline">
                    @csrf
                    <button class="btn btn-sm bg-success-light">
                        <i class="fas fa-check"></i> Accept
                    </button>
                </form>

                <!-- Cancel -->
                <form method="POST" action="{{ route('appointment.cancel', $appointment->id) }}" class="d-inline">
                    @csrf
                    <button class="btn btn-sm bg-danger-light">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </form>

            </div>
        </div>

    @empty
        <p class="text-center text-muted">ما كاين حتى appointment</p>
    @endforelse

</div>
								<!-- /Appointment List -->
                            {{-- <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Patient</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($appointments as $appointment)
                                        <tr>
                                            <td>{{ $appointment->patient?->full_name ?? 'Patient profile in progress' }}</td>
                                            <td>{{ $appointment->appointment_date?->format('Y-m-d') ?? 'Date will be confirmed' }}</td>
                                            <td>{{ $appointment->appointment_time ? \Illuminate\Support\Carbon::parse($appointment->appointment_time)->format('H:i') : 'Time will be confirmed' }}</td>
                                            <td>{{ ucfirst($appointment->status) }}</td>
                                            <td>
                                                @if($appointment->status === 'pending')
                                                    <form class="d-inline" method="POST" action="{{ route('appointment.accept', $appointment->id) }}">
                                                        @csrf
                                                        <button class="btn btn-sm btn-success" type="submit">Accept</button>
                                                    </form>
                                                    <form class="d-inline" method="POST" action="{{ route('appointment.reject', $appointment->id) }}">
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger" type="submit">Reject</button>
                                                    </form>
                                                @else
                                                    <span class="text-muted">No actions</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center text-muted">No appointments found.</td></tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div> --}}
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
