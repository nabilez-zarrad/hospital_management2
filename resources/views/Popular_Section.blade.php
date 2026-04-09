<div class="doctor-slider slider"  id='doctor'>

    @foreach($doctors as $doctor)
    <!-- Doctor Widget -->
    <div class="profile-widget">

        <div class="doc-img">
            <a href="{{ route('doctor.profile', $doctor->id) }}">
                <img class="img-fluid" 
                     src="{{ $doctor->profile_image_url }}" 
                     alt="{{ $doctor->full_name }}">
            </a>

            <a href="javascript:void(0)" class="fav-btn">
                <i class="far fa-bookmark"></i>
            </a>
        </div>

        <div class="pro-content">

            <h3 class="title">
                <a href="{{ route('doctor.profile', $doctor->id) }}">
                    {{ $doctor->full_name }}
                </a> 
                <i class="fas fa-check-circle verified"></i>
            </h3>

            <p class="speciality">
                {{ $doctor->specialty_label }}
            </p>

            <div class="rating">
                <i class="fas fa-star filled"></i>
                <i class="fas fa-star filled"></i>
                <i class="fas fa-star filled"></i>
                <i class="fas fa-star filled"></i>
                <i class="fas fa-star"></i>
                <span class="d-inline-block average-rating">(17)</span>
            </div>

            <ul class="available-info">
                <li>
                    <i class="fas fa-map-marker-alt"></i> 
                    {{ $doctor->address ?? 'Unknown' }}
                </li>

                <li>
                    <i class="far fa-clock"></i> 
                    Available
                </li>

                <li>
                    <i class="far fa-money-bill-alt"></i> 
                    ${{ $doctor->price_min ?? 100 }} - ${{ $doctor->price_max ?? 500 }}
                    <i class="fas fa-info-circle"></i>
                </li>
            </ul>

            <div class="row row-sm">
                <div class="col-6">
                    <a href="{{ route('doctor.profile', $doctor->id) }}" class="btn view-btn">
                        View Profile
                    </a>
                </div>

                <div class="col-6">
                    <a href="{{ auth()->check() ? route('patient.booking', $doctor->id) : route('login') }}" 
                       class="btn book-btn">
                        Book Now
                    </a>
                </div>
            </div>

        </div>

    </div>
    <!-- /Doctor Widget -->
    @endforeach

</div>