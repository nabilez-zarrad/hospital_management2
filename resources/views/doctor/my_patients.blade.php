<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Patients</title>
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
                    <div class="row row-grid">
                        @forelse($patients as $patient)
                            <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="card widget-profile pat-widget-profile">
                                    <div class="card-body">
                                        <div class="profile-det-info">
                                            <h3>{{ $patient->full_name }}</h3>
                                            <div class="patient-details">
                                                <h5><b>Patient ID:</b> P{{ str_pad((string) $patient->id, 4, '0', STR_PAD_LEFT) }}</h5>
                                                <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> {{ $patient->location_label }}</h5>
                                            </div>
                                        </div>
                                        <div class="patient-info mt-3">
                                            <ul class="list-unstyled mb-0">
                                                <li>Phone: <span>{{ $patient->phone ?: 'Phone number will be updated soon' }}</span></li>
                                                <li>Email: <span>{{ $patient->user?->email ?: 'Email address will be updated soon' }}</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12"><div class="alert alert-info mb-0">No patients yet.</div></div>
                        @endforelse
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
