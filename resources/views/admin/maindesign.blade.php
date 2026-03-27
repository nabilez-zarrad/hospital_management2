<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Doccure - Dashboard</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href={{ asset('admin_end/assets/img/favicon.png') }}>
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href={{ asset('admin_end/assets/css/bootstrap.min.css') }}>
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href={{ asset('admin_end/assets/css/font-awesome.min.css') }}>
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href={{ asset('admin_end/assets/css/feathericon.min.css') }}>
		
		<link rel="stylesheet" href="{{ asset('admin_end/assets/plugins/morris/morris.css') }}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href={{ asset('admin_end/assets/css/style.css') }} >
		
		
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <div class="header">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="{{ route('admin.dashboard') }}" class="logo">
						<img src={{ asset('admin_end/assets/img/logo.png') }}  alt="Logo">
					</a>
					<a href="{{ route('admin.dashboard') }}" class="logo logo-small">
						<img src={{ asset('admin_end/assets/img/logo-small.png') }}  alt="Logo" width="30" height="30">
					</a>
                </div>
				<!-- /Logo -->
				
				<a href="javascript:void(0);" id="toggle_btn">
					<i class="fe fe-text-align-left"></i>
				</a>
				
				<div class="top-nav-search">
					<form>
						<input type="text" class="form-control" placeholder="Search here">
						<button class="btn" type="submit"><i class="fa fa-search"></i></button>
					</form>
				</div>
				
				<!-- Mobile Menu Toggle -->
				<a class="mobile_btn" id="mobile_btn">
					<i class="fa fa-bars"></i>
				</a>
				<!-- /Mobile Menu Toggle -->
				
				<!-- Header Right Menu -->
				<ul class="nav user-menu">

					<!-- Notifications -->
					<li class="nav-item dropdown noti-dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<i class="fe fe-bell"></i> <span class="badge badge-pill">3</span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="#">
											<div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src={{ asset('admin_end/assets/img/doctors/doctor-thumb-01.jpg') }} >
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Dr. Ruby Perrin</span> Schedule <span class="noti-title">her appointment</span></p>
													<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="#">
											<div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src={{ asset('admin_end/assets/img/patients/patient1.jpg') }} >
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Charlene Reed</span> has booked her appointment to <span class="noti-title">Dr. Ruby Perrin</span></p>
													<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="#">
											<div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src={{ asset('admin_end/assets/img/patients/patient2.jpg') }} >
												</span>
												<div class="media-body">
												<p class="noti-details"><span class="noti-title">Travis Trimble</span> sent a amount of $210 for his <span class="noti-title">appointment</span></p>
												<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="#">
											<div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src={{ asset('admin_end/assets/img/patients/patient3.jpg') }} >
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Carl Kelly</span> send a message <span class="noti-title"> to his doctor</span></p>
													<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="#">View all Notifications</a>
							</div>
						</div>
					</li>
					<!-- /Notifications -->
					
					<!-- User Menu -->
					<li class="nav-item dropdown has-arrow">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img"><img class="rounded-circle" src={{ asset('admin_end/assets/img/profiles/avatar-01.jpg') }}  width="31" alt="Ryan Taylor"></span>
						</a>
						<div class="dropdown-menu">
							<div class="user-header">
								<div class="avatar avatar-sm">
									<img src={{ asset('admin_end/assets/img/profiles/avatar-01.jpg') }}  alt="User Image" class="avatar-img rounded-circle">
								</div>
								<div class="user-text">
									<h6>{{ Auth::user()->name }}</h6>
									<p class="text-muted mb-0">Administrator</p>
								</div>
							</div>
							<a class="dropdown-item" href="{{ route('profile.edit') }}">My Profile</a>
							<a class="dropdown-item" href="{{ route('profile.edit') }}">Settings</a>

                            
                            
                            
                            
                            <!--logout end administation-->
                              <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item border-0 bg-transparent w-100 text-left">
                                        {{ __('Log Out') }}
                                    </button>
                               </form>
							
                        



						</div>
					</li>
					<!-- /User Menu -->
					
				</ul>
				<!-- /Header Right Menu -->
				
            </div>
			<!-- /Header -->
			
			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title">
								<span>Main</span>
							</li>
							<li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
								<a href="{{ route('admin.dashboard') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
							</li>
							<li class="{{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
								<a href="{{ route('admin.appointments.index') }}"><i class="fe fe-layout"></i> <span>Appointments</span></a>
							</li>
							<li class="{{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}">
								<a href="{{ route('admin.doctors.index') }}"><i class="fe fe-user-plus"></i> <span>Doctors</span></a>
							</li>
							<li class="{{ request()->routeIs('admin.patients.*') ? 'active' : '' }}">
								<a href="{{ route('admin.patients.index') }}"><i class="fe fe-user"></i> <span>Patients</span></a>
							</li>
							<li class="{{ request()->routeIs('admin.specialties.*') ? 'active' : '' }}">
								<a href="{{ route('admin.specialties.index') }}"><i class="fe fe-tag"></i> <span>Specialties</span></a>
							</li>
							<li class="menu-title">
								<span>Account</span>
							</li>
							<li class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
								<a href="{{ route('profile.edit') }}"><i class="fe fe-user"></i> <span>Profile</span></a>
							</li>
							<li>
								<a href="{{ route('index') }}"><i class="fe fe-globe"></i> <span>Public site</span></a>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
			<!-- /Page Wrapper -->
		
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src={{ asset('admin_end/assets/js/jquery-3.2.1.min.js') }} ></script>
		
		<!-- Bootstrap Core JS -->
        <script src={{ asset('admin_end/assets/js/popper.min.js') }} ></script>
        <script src={{ asset('admin_end/assets/js/bootstrap.min.js') }} ></script>
		
		<!-- Slimscroll JS -->
        <script src={{ asset('admin_end/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}  ></script>
		
		<script src={{ asset('admin_end/assets/plugins/raphael/raphael.min.js') }} ></script>    
		<script src={{ asset('admin_end/assets/plugins/morris/morris.min.js') }} ></script>  
		<script src={{ asset('admin_end/assets/js/chart.morris.js') }} ></script>
		
		<!-- Custom JS -->
		<script  src={{ asset('admin_end/assets/js/script.js') }} ></script>
		
    </body>
</html>