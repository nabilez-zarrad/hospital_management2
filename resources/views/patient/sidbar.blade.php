<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
    <div class="profile-sidebar">
        <div class="widget-profile pro-widget-content">
            <div class="profile-info-widget">
                <a href="#" class="booking-doc-img">
                    <img src="{{ auth()->user()->patient?->profile_image_url ?? asset('front-end/assets/img/patients/patient.jpg') }}" alt="Patient">
                </a>
                <div class="profile-det-info">
                    <h3>{{ auth()->user()->patient?->full_name ?? auth()->user()->name }}</h3>
                    <div class="patient-details">
                        <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> {{ auth()->user()->patient?->location_label ?? (auth()->user()->address ?: 'Address will be updated soon') }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-widget">
            <nav class="dashboard-menu">
                <ul>
                    <li>
                        <a href="{{ route('patient.dashboard') }}">
                            <i class="fas fa-columns"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('my.appointments') }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>My Appointments</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('patient.favourites') }}">
                            <i class="fas fa-bookmark"></i>
                            <span>Favourites</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('patient.profile.settings') }}">
                            <i class="fas fa-user-cog"></i>
                            <span>Profile Settings</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 text-left">
                                <i class="fas fa-sign-out-alt"></i> Log Out
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
