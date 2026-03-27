<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Favourites</title>
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
            <h2 class="breadcrumb-title">Favourites</h2>
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

                    <div class="row row-grid">
                        @forelse($favouriteDoctors as $doctor)
                            <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="profile-widget">
                                    <div class="doc-img">
                                        <a href="{{ route('doctor.profile', $doctor->id) }}">
                                            <img class="img-fluid" alt="Doctor" src="{{ $doctor->profile_image_url }}">
                                        </a>
                                    </div>
                                    <div class="pro-content">
                                        <h3 class="title">
                                            <a href="{{ route('doctor.profile', $doctor->id) }}">Dr. {{ $doctor->full_name }}</a>
                                        </h3>
                                        <p class="speciality">{{ $doctor->specialty_label }}</p>
                                        <ul class="available-info">
                                            <li><i class="fas fa-map-marker-alt"></i> {{ $doctor->location_label }}</li>
                                            <li><i class="far fa-money-bill-alt"></i> {{ $doctor->is_free ? 'Free' : '$' . number_format((float) $doctor->price, 2) }}</li>
                                        </ul>
                                        <div class="row row-sm">
                                            <div class="col-6">
                                                <a href="{{ route('doctor.profile', $doctor->id) }}" class="btn view-btn">View</a>
                                            </div>
                                            <div class="col-6">
                                                <form method="POST" action="{{ route('patient.favourites.toggle', $doctor->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn book-btn">Remove</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info mb-0">You have no favourite doctors yet.</div>
                            </div>
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
</body>
</html>
