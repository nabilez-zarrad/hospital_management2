@extends('maindesign')
@section('content')
<section class="section section-doctor">
    <div class="container">
        <div class="section-header text-center">
            <h2>Our Doctors</h2>
            <p class="sub-title">Find the best doctors and book an appointment</p>
        </div>
        <div class="row">
        @foreach($medecins ?? [] as $medecin)
            <div class="col-md-4 col-lg-3 col-sm-6">
                <div class="profile-widget">
                    <div class="doc-img">
                        <img class="img-fluid" src="{{ $medecin->image ? asset('storage/'.$medecin->image) : asset('front-end/assets/img/doctors/doctor-thumb-01.jpg') }}" alt="Doctor Image" >
                    </div>
                    <div class="pro-content">
                            <h3 class="title">Dr. {{ $medecin->first_name }} {{ $medecin->last_name }}</h3>
                            <p class="speciality">{{ $medecin->section->name ?? $medecin->speciality ?? '—' }}</p>
                        <div class="row row-sm">
                            <div class="col-6">
                                <a href="{{ route('doctor.profile',$medecin->id) }}" class="btn view-btn"> View Profile</a>
                            </div>
                            <div class="col-6">
                                @auth
                                    @if(in_array(auth()->user()->role, ['patient', 'user'], true))
                                        <a href="{{ route('patient.booking', $medecin->id) }}" class="btn book-btn">Book Now</a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn book-btn">Book Now</a>
                                    @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn book-btn">Book Now</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</section>
@endsection
