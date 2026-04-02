
<section class="section section-search">
				<div class="container-fluid">
					<div class="banner-wrapper">
						<div class="banner-header text-center">
							<h1>Search Doctor, Make an Appointment</h1>
							<p>Discover the best doctors, clinic & hospital the city nearest to you.</p>
						</div>
                         
						<!-- Search -->
						<div class="search-box">
							<form action="{{ route('search.doctors') }}" method="GET">
								<div class="form-group search-location">
									<input type="text" name="location" class="form-control" placeholder="Search Location" value="{{ request('location') }}">
									<span class="form-text">Based on your Location</span>
								</div>
								<div class="form-group search-info">
									<input type="text" name="search" class="form-control" placeholder="Search Doctors, Clinics, Hospitals, Diseases Etc" value="{{ request('search') }}">
									<span class="form-text">Ex : Dental or Sugar Check up etc</span>
								</div>
								<button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i> <span>Search</span></button>
							</form>
						</div>
						<!-- /Search -->
						
					</div>
				</div>
			</section>
