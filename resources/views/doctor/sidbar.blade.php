<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
							
							<!-- Profile Sidebar -->
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
                                            <li>
												<a href="{{ route('doctor.dashboard') }}">
													<i class="fas fa-columns"></i>
													<span>Dashboard</span>
												</a>
											</li>


											<li>
												<a href="{{ route('doctor.appointments') }}">
													<i class="fas fa-calendar-check"></i>
													<span>Appointments</span>
												</a>
											</li>



											
											<li>
												<a href="{{ route('doctor.my_patients') }}">
													<i class="fas fa-user-injured"></i>
													<span>My Patients</span>
												</a>
											</li>
											<li>
												<a href="{{ route('doctor.schedule_timings') }}">
													<i class="fas fa-hourglass-start"></i>
													<span>Schedule Timings</span>
												</a>
											</li>
							
		
											<li>
												<a href="{{ route('doctor.profile_settings') }}">
													<i class="fas fa-user-cog"></i>
													<span>Profile Settings</span>
												</a>
											</li>
									
										
											<br></br>
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
							<!-- /Profile Sidebar -->
							
						</div>
