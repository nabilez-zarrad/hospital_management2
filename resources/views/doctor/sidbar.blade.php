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
                    <img src="{{ auth()->user()->doctor?->profile_image_url ?? asset('front-end/assets/img/doctors/doctor-thumb-02.jpg') }}" alt="User Image">
                </a>
                <div class="profile-det-info">
                    <h3>Dr. {{ auth()->user()->doctor?->full_name ?? 'Doctor' }}</h3>
                    <div class="patient-details">
                        <h5 class="mb-0">{{ auth()->user()->doctor?->specialty_label ?? 'General Physician' }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-widget">
            <nav class="dashboard-menu">
                <ul>
                    <li class="{{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('doctor.dashboard') }}">
                            <i class="fas fa-columns"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('doctor.appointments') ? 'active' : '' }}">
                        <a href="{{ route('doctor.appointments') }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>Appointments</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('doctor.my_patients') ? 'active' : '' }}">
                        <a href="{{ route('doctor.my_patients') }}">
                            <i class="fas fa-user-injured"></i>
                            <span>My Patients</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('doctor.schedule_timings') ? 'active' : '' }}">
                        <a href="{{ route('doctor.schedule_timings') }}">
                            <i class="fas fa-hourglass-start"></i>
                            <span>Schedule Timings</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('doctor.profile_settings') ? 'active' : '' }}">
                        <a href="{{ route('doctor.profile_settings') }}">
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
