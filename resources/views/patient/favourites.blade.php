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
    @include('components.premium-dashboard-styles')
    <style>
        .fav-shell {
            max-width: none;
            margin: 0;
        }

        .fav-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.08);
            overflow: hidden;
            background: #fff;
            height: 100%;
        }

        .fav-card .doc-img img {
            width: 100%;
            height: 170px;
            object-fit: cover;
        }

        .fav-card .pro-content {
            padding: 12px;
        }

        .fav-card .title {
            font-size: 16px;
            margin-bottom: 2px;
            font-weight: 700;
            color: #0f172a;
        }

        .fav-card .title a {
            color: inherit;
        }

        .fav-card .speciality {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .fav-card .available-info {
            margin-bottom: 10px;
        }

        .fav-card .available-info li {
            font-size: 13px;
            margin-bottom: 4px;
            color: #334155;
        }

        .fav-card .available-info li i {
            color: #2563eb;
            width: 16px;
        }

        .fav-card .btn {
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            padding: 7px 10px;
        }

        .fav-card .view-btn {
            border: 1px solid #2563eb;
            color: #2563eb;
            background: #fff;
        }

        .fav-card .book-btn {
            border: 0;
            color: #fff;
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    @include('patient.header')

    <div class="content">
        <div class="container-fluid fav-shell">
            <div class="premium-hero mb-3">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>Favourites</h2>
                        <p>Your saved doctors for quick access and booking.</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('patient.search') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-search mr-1"></i>Find More Doctors
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

                    <div class="row row-grid">
                        @forelse($favouriteDoctors as $doctor)
                            <div class="col-md-6 col-lg-4 col-xl-4 mb-3">
                                <div class="fav-card">
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
                                                <a href="{{ route('doctor.profile', $doctor->id) }}" class="btn view-btn btn-block">View</a>
                                            </div>
                                            <div class="col-6">
                                                <form method="POST" action="{{ route('patient.favourites.toggle', $doctor->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn book-btn btn-block">Remove</button>
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
