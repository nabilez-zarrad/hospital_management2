<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Doctor Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link href="{{ asset('front-end/assets/img/favicon.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fancybox/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/style.css') }}">
</head>
<body>
<div class="main-wrapper">
    @include('patient.header')

    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <h2 class="breadcrumb-title">Doctor Profile</h2>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="doctor-widget">
                        <div class="doc-info-left">
                            <div class="doctor-img">
                                <img src="{{ $doctor->profile_image_url }}" class="img-fluid" alt="Doctor Image">
                            </div>
                            <div class="doc-info-cont">
                                <h4 class="doc-name">Dr. {{ $doctor->full_name }}</h4>
                                <p class="doc-speciality">{{ $doctor->specialty_label }}</p>
                                <p class="doc-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $doctor->location_label }}
                                </p>
                                <div class="clinic-services">
                                    @forelse($doctor->services as $service)
                                        <span>{{ $service->service }}</span>
                                    @empty
                                        <span>No services added</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="doc-info-right">
                            <div class="clini-infos">
                                <ul>
                                    <li><i class="far fa-comment"></i> {{ $doctor->total_reviews ?? 0 }} Feedback</li>
                                    <li><i class="far fa-money-bill-alt"></i> {{ $doctor->is_free ? 'Free' : '$' . number_format((float) $doctor->price, 2) }}</li>
                                    <li><i class="fas fa-map-marker-alt"></i>{{ $doctor->location_label }}</li>
                                </ul>
                            </div>
                            @auth
                                @if(in_array(auth()->user()->role, ['patient', 'user'], true))
                                    <form method="POST" action="{{ route('patient.favourites.toggle', $doctor->id) }}" class="mb-2">
                                        @csrf
                                        <button class="btn btn-white btn-block" type="submit">
                                            <i class="far {{ $isFavourite ? 'fa-bookmark' : 'fa-bookmark' }}"></i>
                                            {{ $isFavourite ? 'Remove from favourites' : 'Add to favourites' }}
                                        </button>
                                    </form>
                                @endif
                            @endauth
                            <div class="clinic-booking">
                                <a class="apt-btn" href="{{ route('patient.booking', ['id' => $doctor->id]) }}">Book Appointment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">About</h4>
                    <p>{{ $doctor->biography ?: 'No biography added yet.' }}</p>

                    <h5 class="mt-4">Education</h5>
                    <ul class="mb-3">
                        @forelse($doctor->educations as $education)
                            <li>{{ $education->degree ?: 'Degree details will be updated soon' }} - {{ $education->college ?: 'College details will be updated soon' }} ({{ $education->year_of_completion ?: 'Completion year will be updated soon' }})</li>
                        @empty
                            <li>No education records.</li>
                        @endforelse
                    </ul>

                    <h5 class="mt-4">Experience</h5>
                    <ul class="mb-3">
                        @forelse($doctor->experiences as $experience)
                            <li>{{ $experience->hospital_name ?: 'Hospital details will be updated soon' }} ({{ $experience->from ?: 'Start date pending' }} - {{ $experience->to ?: 'End date pending' }})</li>
                        @empty
                            <li>No experience records.</li>
                        @endforelse
                    </ul>

                    <h5 class="mt-4">Awards</h5>
                    <ul class="mb-0">
                        @forelse($doctor->awards as $award)
                            <li>{{ $award->award ?: 'Award details will be updated soon' }} ({{ $award->year ?: 'Year pending' }})</li>
                        @empty
                            <li>No awards records.</li>
                        @endforelse
                    </ul>
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
