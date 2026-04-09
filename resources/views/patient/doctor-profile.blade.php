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
    @include('components.premium-dashboard-styles')
    <style>
        .profile-shell {
            max-width: 1100px;
            margin: 0 auto;
        }

        .profile-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.08);
            overflow: hidden;
            background: #fff;
        }

        .profile-card .card-body {
            padding: 16px;
        }

        .doctor-widget .doctor-img img {
            width: 92px;
            height: 92px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid #dbe3ef;
        }

        .doc-info-cont .doc-name {
            font-size: 17px;
            margin-bottom: 2px;
            color: #0f172a;
        }

        .doc-info-cont .doc-speciality {
            font-size: 14px;
            margin-bottom: 6px;
            color: #64748b;
        }

        .doc-info-cont .doc-location {
            font-size: 13px;
            margin-bottom: 8px;
            color: #334155;
        }

        .clinic-services span {
            font-size: 12px;
            padding: 4px 8px;
            border: 1px solid #dbe3ef;
            border-radius: 8px;
            background: #f8fbff;
        }

        .clini-infos ul li {
            font-size: 13px;
            margin-bottom: 7px;
            color: #334155;
        }

        .clini-infos ul li i {
            color: #2563eb;
            margin-right: 6px;
        }

        .doc-info-right .btn,
        .clinic-booking .apt-btn {
            border-radius: 9px !important;
            font-weight: 600;
            padding: 8px 12px !important;
            font-size: 13px;
        }

        .clinic-booking .apt-btn {
            background: linear-gradient(135deg, #2563eb, #1d4ed8) !important;
            border: 0 !important;
            color: #fff !important;
        }

        .profile-content h4 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .profile-content h5 {
            font-size: 17px;
            margin-top: 12px !important;
            margin-bottom: 8px;
        }

        .profile-content p,
        .profile-content li {
            font-size: 13px;
            color: #334155;
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    @include('patient.header')

    <div class="content">
        <div class="container-fluid profile-shell">
            <div class="premium-hero mb-3">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>Doctor Profile</h2>
                        <p>Professional details and booking information.</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('patient.search') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i>Back To Search
                        </a>
                    </div>
                </div>
            </div>

            <div class="card profile-card">
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
                                
<ul class="clinic-gallery">
    @if($doctor->clinicImages && $doctor->clinicImages->count())
    <ul class="clinic-gallery d-flex flex-wrap" style="gap:10px;">

        @foreach($doctor->clinicImages as $image)
            @if($image->image)
                <li style="list-style:none;">
                    
                    <a href="{{ asset('storage/' . $image->image) }}" data-fancybox="gallery">
                        <img 
                            src="{{ asset('storage/' . $image->image) }}" 
                            alt="Clinic Image"
                            style="width:60px; height:50px; object-fit:cover; border-radius:10px;">
                    </a>

                </li>
            @endif
        @endforeach

    </ul>
@endif



                          

                        
                    



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

            <div class="card profile-card mt-3">
                <div class="card-body profile-content">
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
