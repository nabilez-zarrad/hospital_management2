<style>
    .profile-sidebar .profile-info-widget .booking-doc-img img {
        width: 62px;
        height: 62px;
        object-fit: cover;
    }

    .profile-sidebar .profile-det-info h3 {
        font-size: 15px;
        line-height: 1.25;
        margin-bottom: 4px;
    }

    .profile-sidebar .patient-details h5 {
        font-size: 12px;
        color: #64748b;
    }

    .dashboard-menu .logout-form {
        margin: 0;
    }

    .dashboard-menu .logout-btn {
        width: 100%;
        border: 0;
        background: transparent;
        color: #64748b;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 17px;
        font-weight: 500;
        line-height: 1;
        border-radius: 10px;
        transition: .2s ease;
    }

    .dashboard-menu .logout-btn:hover {
        color: #0f172a;
        background: #f8fafc;
    }

    .dashboard-menu .logout-btn:focus {
        outline: none;
        box-shadow: none;
    }
</style>

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
                    <li class="{{ request()->routeIs('patient.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('patient.dashboard') }}">
                            <i class="fas fa-columns"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('my.appointments') ? 'active' : '' }}">
                        <a href="{{ route('my.appointments') }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>My Appointments</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('patient.favourites') ? 'active' : '' }}">
                        <a href="{{ route('patient.favourites') }}">
                            <i class="fas fa-bookmark"></i>
                            <span>Favourites</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('patient.profile.settings') ? 'active' : '' }}">
                        <a href="{{ route('patient.profile.settings') }}">
                            <i class="fas fa-user-cog"></i>
                            <span>Profile Settings</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="logout-form">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Log Out</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
