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
</head>
<body>
<div class="main-wrapper">
    @include('patient.header')

    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h2 class="breadcrumb-title">Search Doctors</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <form method="GET" action="{{ route('patient.search') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Doctor name">
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="text" name="speciality" value="{{ request('speciality') }}" class="form-control" placeholder="Speciality">
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="gender" class="form-control">
                            <option value="">Any gender</option>
                            <option value="male" @selected(request('gender') === 'male')>Male</option>
                            <option value="female" @selected(request('gender') === 'female')>Female</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <button class="btn btn-primary btn-block" type="submit">Search</button>
                    </div>
                </div>
            </form>

            @forelse($doctors as $doctor)
                <div class="card">
                    <div class="card-body">
                        <div class="doctor-widget">
                            <div class="doc-info-left">
                                <div class="doctor-img">
                                    <a href="{{ route('doctor.profile', $doctor->id) }}">
                                        <img src="{{ $doctor->profile_image_url }}" class="img-fluid" alt="Doctor">
                                    </a>
                                </div>
                                <div class="doc-info-cont">
                                    <h4 class="doc-name">
                                        <a href="{{ route('doctor.profile', $doctor->id) }}">Dr. {{ $doctor->full_name }}</a>
                                    </h4>
                                    <p class="doc-speciality">{{ $doctor->specialty_label }}</p>
                                                <div class="rating">
													<i class="fas fa-star filled"></i>
													<i class="fas fa-star filled"></i>
													<i class="fas fa-star filled"></i>
													<i class="fas fa-star filled"></i>
													<i class="fas fa-star"></i>
													<span class="d-inline-block average-rating">(35)</span>
												</div>
                                    <p class="doc-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $doctor->location_label }}
                                    </p>
                                    
                                </div>
                            </div>
                            <div class="doc-info-right">
                                <div class="clini-infos">
                                    <ul>
                                        <li><i class="far fa-comment"></i> {{ $doctor->total_reviews ?? 0 }} reviews</li>
                                        <li><i class="far fa-money-bill-alt"></i> {{ $doctor->is_free ? 'Free' : '$' . number_format((float) $doctor->price, 2) }}</li>
                                        <li><i class="fas fa-map-marker-alt"></i>{{ $doctor->location_label }}</li>
                                    </ul>
                                </div>
                                <div class="clinic-booking">
                                    <a class="view-pro-btn" href="{{ route('doctor.profile', $doctor->id) }}">View Profile</a>
                                    <a class="apt-btn" href="{{ route('patient.booking', ['id' => $doctor->id]) }}">Book Appointment</a>
                                </div>
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
