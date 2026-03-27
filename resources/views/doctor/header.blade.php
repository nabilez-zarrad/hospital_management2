<header class="header">
    <nav class="navbar navbar-expand-lg header-nav">
        <div class="navbar-header">
            <a href="{{ route('doctor.dashboard') }}" class="navbar-brand logo">
                <img src="{{ asset('front-end/assets/img/logo.png') }}" class="img-fluid" alt="Logo">
            </a>
        </div>

        <div class="main-menu-wrapper">
            <ul class="main-nav">
                <li><a href="{{ route('doctor.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('doctor.appointments') }}">Appointments</a></li>
                <li><a href="{{ route('doctor.my_patients') }}">Patients</a></li>
            </ul>
        </div>

        <ul class="nav header-navbar-rht">
            <li class="nav-item dropdown has-arrow logged-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <span class="user-img">
                        <img class="rounded-circle" src="{{ auth()->user()->doctor?->profile_image_url ?? asset('front-end/assets/img/doctors/doctor-thumb-02.jpg') }}" width="31" alt="User">
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="user-header">
                        <div class="user-text">
                            <h6>{{ auth()->user()->doctor?->full_name ?? auth()->user()->name }}</h6>
                            <p class="text-muted mb-0">Doctor</p>
                        </div>
                    </div>
                    <a class="dropdown-item" href="{{ route('doctor.profile_settings') }}">Profile Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item" type="submit">Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
</header>
