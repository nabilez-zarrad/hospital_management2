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
