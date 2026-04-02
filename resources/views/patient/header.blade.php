<style>
    .header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1040;
        background: #fff;
    }

    .main-wrapper {
        padding-top: 78px;
    }

    .card,
    .profile-widget,
    .dashboard-widget,
    .widget-profile {
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px !important;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08) !important;
        overflow: hidden;
        background: #fff;
    }

    .card .card-body {
        padding: 16px !important;
    }

    .breadcrumb-bar {
        background: transparent !important;
        border: 0 !important;
        padding: 14px 0 6px !important;
        min-height: auto !important;
    }

    .breadcrumb-bar .container-fluid {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
        padding: 12px 16px;
    }

    .breadcrumb-title {
        color: #0f172a !important;
        font-weight: 700;
        font-size: 20px;
        margin-bottom: 0;
    }

    .card-header {
        background: linear-gradient(180deg, #f8fbff 0%, #ffffff 100%) !important;
        color: #0f172a !important;
        border-bottom: 1px solid #e2e8f0 !important;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
    }

    .card-header .card-title,
    .card-header h4,
    .card-header h5 {
        color: #0f172a !important;
        font-weight: 700;
        margin-bottom: 0;
    }

    .header-navbar-rht .user-img img {
        width: 28px !important;
        height: 28px !important;
        object-fit: cover;
    }

    .user-header .user-text h6 {
        font-size: 14px !important;
        margin-bottom: 2px;
    }

    .user-header .user-text p {
        font-size: 12px !important;
    }
</style>

<header class="header">
    <nav class="navbar navbar-expand-lg header-nav">
        <div class="navbar-header">
            <a href="{{ auth()->check() ? route('dashboard') : route('index') }}" class="navbar-brand logo">
                <img src="{{ asset('front-end/assets/img/logo.png') }}" class="img-fluid" alt="Logo">
            </a>
        </div>

        <div class="main-menu-wrapper">
            @php($isPatientRole = auth()->check() && in_array(auth()->user()->role, ['patient', 'user'], true))
            <ul class="main-nav">
                <li><a href="{{ $isPatientRole ? route('patient.dashboard') : route('index') }}">Home</a></li>
                <li><a href="{{ $isPatientRole ? route('patient.search') : route('search.doctors') }}">Search Doctors</a></li>
                @auth
                    @if($isPatientRole)
                        <li><a href="{{ route('patient.favourites') }}">Favourites</a></li>
                        <li><a href="{{ route('my.appointments') }}">My Appointments</a></li>
                    @endif
                @endauth
            </ul>
        </div>

        <ul class="nav header-navbar-rht">
            @auth
                <li class="nav-item dropdown has-arrow logged-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="{{ auth()->user()->patient?->profile_image_url ?? asset('front-end/assets/img/patients/patient.jpg') }}" width="31" alt="User">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="user-header">
                            <div class="user-text">
                                <h6>{{ auth()->user()?->name ?? 'Patient' }}</h6>
                                <p class="text-muted mb-0">{{ ucfirst(auth()->user()->role ?? 'user') }}</p>
                            </div>
                        </div>
                        @if($isPatientRole)
                            <a class="dropdown-item" href="{{ route('patient.profile.settings') }}">Profile Settings</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">Logout</button>
                        </form>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link header-login" href="{{ route('login') }}">Login</a>
                </li>
            @endauth
        </ul>
    </nav>
</header>
