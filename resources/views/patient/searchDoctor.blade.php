<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Search Doctors</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link href="{{ asset('front-end/assets/img/favicon.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/style.css') }}">
    @include('components.premium-dashboard-styles')
    <style>
        .search-shell {
            max-width: 1200px;
            margin: 0 auto;
        }

        .search-filters {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
            padding: 16px;
            margin-bottom: 18px;
        }

        .search-filters .form-control,
        .search-filters .custom-select {
            height: 44px;
            border-radius: 10px;
            border-color: #dbe3ef;
        }

        .doctor-search-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
            margin-bottom: 16px;
            overflow: hidden;
        }

        .doctor-search-body {
            padding: 16px;
        }

        .doctor-photo {
            width: 94px;
            height: 94px;
            border-radius: 12px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
        }

        .doctor-title {
            margin-bottom: 2px;
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
        }

        .doctor-title a {
            color: inherit;
        }

        .doctor-meta {
            color: #64748b;
            margin-bottom: 8px;
        }

        .doctor-rating {
            color: #f59e0b;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .doctor-rating .score {
            color: #334155;
            margin-left: 6px;
            font-weight: 600;
        }

        .doctor-details {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .doctor-details li {
            color: #334155;
            margin-bottom: 7px;
            font-size: 14px;
        }

        .doctor-details li i {
            color: #2563eb;
            width: 20px;
        }

        .doctor-actions .btn {
            border-radius: 10px;
            font-weight: 600;
            min-width: 170px;
        }

        .doctor-actions .btn + .btn {
            margin-top: 10px;
        }

        @media (max-width: 991px) {
            .doctor-title {
                font-size: 22px;
            }

            .doctor-actions {
                margin-top: 12px;
            }

            .doctor-actions .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    @include('patient.header')

    <div class="content">
        <div class="container-fluid search-shell">
            <div class="premium-hero mb-3">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>Search Doctors</h2>
                        <p>Find the right specialist and book your appointment quickly.</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('patient.dashboard') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i>Back To Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <form method="GET" action="{{ route('patient.search') }}" class="search-filters">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Doctor name">
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="text" name="speciality" value="{{ request('speciality') }}" class="form-control" placeholder="Speciality">
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="gender" class="custom-select">
                            <option value="">Any gender</option>
                            <option value="male" @selected(request('gender') === 'male')>Male</option>
                            <option value="female" @selected(request('gender') === 'female')>Female</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <button class="btn btn-primary btn-block" type="submit">
                            <i class="fas fa-search mr-1"></i>Search
                        </button>
                    </div>
                </div>
            </form>

            @forelse($doctors as $doctor)
                <div class="doctor-search-card">
                    <div class="doctor-search-body">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <div class="d-flex align-items-start">
                                    <a href="{{ route('doctor.profile', $doctor->id) }}" class="mr-3">
                                        <img src="{{ $doctor->profile_image_url }}" class="doctor-photo" alt="Doctor">
                                    </a>
                                    <div>
                                        <h4 class="doctor-title mb-0">
                                            <a href="{{ route('doctor.profile', $doctor->id) }}">Dr. {{ $doctor->full_name }}</a>
                                        </h4>
                                        <p class="doctor-meta">{{ $doctor->specialty_label }}</p>

                                        <div class="doctor-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <span class="score">{{ number_format((float) ($doctor->rating ?? 0), 1) }}</span>
                                        </div>

                                        <ul class="doctor-details">
                                            <li><i class="fas fa-map-marker-alt"></i>{{ $doctor->location_label }}</li>
                                            <li><i class="far fa-comment"></i>{{ $doctor->total_reviews ?? 0 }} reviews</li>
                                            <li><i class="far fa-money-bill-alt"></i>{{ $doctor->is_free ? 'Free' : '$' . number_format((float) $doctor->price, 2) }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5 text-lg-right doctor-actions">
                                <a class="btn btn-outline-primary d-block d-lg-inline-block" href="{{ route('doctor.profile', $doctor->id) }}">
                                    <i class="fas fa-user-md mr-1"></i>View Profile
                                </a>
                                <a class="btn btn-primary d-block d-lg-inline-block" href="{{ route('patient.booking', ['id' => $doctor->id]) }}">
                                    <i class="fas fa-calendar-plus mr-1"></i>Book Appointment
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info mb-0">No doctors found for your current filters.</div>
            @endforelse
        </div>
    </div>
</div>

<script src="{{ asset('front-end/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('front-end/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('front-end/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front-end/assets/js/script.js') }}"></script>
</body>
</html>
