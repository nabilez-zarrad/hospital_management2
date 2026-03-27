<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/doctor-profile-settings.html  30 Nov 2019 04:12:14 GMT -->
<head>
		<meta charset="utf-8">
		<title>Doccure</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="{{ asset('front-end/assets/img/favicon.png') }}" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ asset('front-end/assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fontawesome/css/all.min.css') }}">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{ asset('front-end/assets/plugins/select2/css/select2.min.css') }}">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ asset('front-end/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}">
		
		<link rel="stylesheet" href="{{ asset('front-end/assets/plugins/dropzone/dropzone.min.css') }}">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{ asset('front-end/assets/css/style.css') }}">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">

    @include('doctor.header')

    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('doctor.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Profile Settings</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">

                @include('doctor.sidbar')

                <div class="col-md-7 col-lg-8 col-xl-9">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('doctor.profile.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Basic Information</h4>
                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="change-avatar">
                                                <div class="profile-img">
                                                    <img
                                                        src="{{ $doctor && $doctor->image ? asset('storage/' . $doctor->image) : asset('front-end/assets/img/doctors/doctor-thumb-02.jpg') }}"
                                                        alt="User Image">
                                                </div>
                                                <div class="upload-img">
                                                    <div class="change-photo-btn">
                                                        <span><i class="fa fa-upload"></i> Upload Photo</span>
                                                        <input type="file" class="upload" name="image">
                                                    </div>
                                                    <small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username"
                                                value="{{ old('username', $doctor->username ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ old('email', $doctor->email ?? auth()->user()->email) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="first_name"
                                                value="{{ old('first_name', $doctor->first_name ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="last_name"
                                                value="{{ old('last_name', $doctor->last_name ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ old('phone', $doctor->phone ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control select" name="gender">
                                                <option value="">Select</option>
                                                <option value="male" {{ old('gender', $doctor->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('gender', $doctor->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label>Date of Birth</label>
                                            <input type="date" class="form-control" name="date_of_birth"
                                                value="{{ old('date_of_birth', optional($doctor->date_of_birth)->format('Y-m-d')) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">About Me</h4>
                                <div class="form-group mb-0">
                                    <label>Biography</label>
                                    <textarea class="form-control" rows="5" name="biography">{{ old('biography', $doctor->biography ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Clinic Info</h4>
                                <div class="row form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Clinic Name</label>
                                            <input type="text" class="form-control" name="clinic_name"
                                                value="{{ old('clinic_name', $doctor->clinic_name ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Clinic Address</label>
                                            <input type="text" class="form-control" name="clinic_address"
                                                value="{{ old('clinic_address', $doctor->clinic_address ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Clinic Images</label>
                                            <input type="file" name="clinic_images[]" multiple class="form-control">
                                        </div>

                                        @if(isset($doctor) && $doctor->clinicImages && $doctor->clinicImages->count())
                                            <div class="upload-wrap">
                                                @foreach($doctor->clinicImages as $clinicImage)
                                                    <div class="upload-images mr-2 mb-2 d-inline-block">
                                                        <img src="{{ asset('storage/' . $clinicImage->image) }}" alt="Upload Image" width="100">
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card contact-card">
                            <div class="card-body">
                                <h4 class="card-title">Contact Details</h4>
                                <div class="row form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address Line 1</label>
                                            <input type="text" class="form-control" name="address_line_1"
                                                value="{{ old('address_line_1', $doctor->address_line_1 ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address Line 2</label>
                                            <input type="text" class="form-control" name="address_line_2"
                                                value="{{ old('address_line_2', $doctor->address_line_2 ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city"
                                                value="{{ old('city', $doctor->city ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State / Province</label>
                                            <input type="text" class="form-control" name="state"
                                                value="{{ old('state', $doctor->state ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" class="form-control" name="country"
                                                value="{{ old('country', $doctor->country ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="text" class="form-control" name="postal_code"
                                                value="{{ old('postal_code', $doctor->postal_code ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Pricing</h4>

                                <div class="form-group mb-3">
                                    <div id="pricing_select">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="price_free" name="is_free" class="custom-control-input" value="1"
                                                {{ old('is_free', $doctor->is_free ?? 1) == 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="price_free">Free</label>
                                        </div>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="price_custom" name="is_free" class="custom-control-input" value="0"
                                                {{ old('is_free', $doctor->is_free ?? 1) == 0 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="price_custom">Custom Price (per hour)</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row custom_price_cont" id="custom_price_cont"
                                    style="{{ old('is_free', $doctor->is_free ?? 1) == 0 ? '' : 'display:none;' }}">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="price"
                                            value="{{ old('price', $doctor->price ?? '') }}" placeholder="20">
                                        <small class="form-text text-muted">Custom price you can add</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card services-card">
                            <div class="card-body">
                                <h4 class="card-title">Services and Specialization</h4>

                                <div class="form-group">
                                    <label>Services</label>
                                    <input type="text" data-role="tagsinput" class="input-tags form-control"
                                        placeholder="Enter Services" name="services"
                                        value="{{ old('services', isset($doctor) && $doctor->services ? $doctor->services->pluck('service')->implode(',') : '') }}"
                                        id="services">
                                    <small class="form-text text-muted">Note : Type & Press enter to add new services</small>
                                </div>

                                <div class="form-group mb-0">
                                    <label>Specialization</label>
                                    <input class="input-tags form-control" type="text" data-role="tagsinput"
                                        placeholder="Enter Specialization" name="specializations"
                                        value="{{ old('specializations', isset($doctor) && $doctor->specializations ? $doctor->specializations->pluck('specialization')->implode(',') : '') }}"
                                        id="specialist">
                                    <small class="form-text text-muted">Note : Type & Press enter to add new specialization</small>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Education</h4>
                                <div class="education-info">
                                    @php
                                        $educations = old('education_degree')
                                            ? collect(old('education_degree'))->map(function ($item, $index) {
                                                return [
                                                    'degree' => old('education_degree')[$index] ?? '',
                                                    'college' => old('education_college')[$index] ?? '',
                                                    'year' => old('education_year')[$index] ?? '',
                                                ];
                                            })
                                            : (isset($doctor) && $doctor->educations && $doctor->educations->count()
                                                ? $doctor->educations->map(fn($e) => [
                                                    'degree' => $e->degree,
                                                    'college' => $e->college,
                                                    'year' => $e->year_of_completion,
                                                ])
                                                : collect([['degree' => '', 'college' => '', 'year' => '']]));
                                    @endphp

                                    @foreach($educations as $education)
                                        <div class="row form-row education-cont">
                                            <div class="col-12 col-md-10 col-lg-11">
                                                <div class="row form-row">
                                                    <div class="col-12 col-md-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Degree</label>
                                                            <input type="text" class="form-control" name="education_degree[]" value="{{ $education['degree'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>College/Institute</label>
                                                            <input type="text" class="form-control" name="education_college[]" value="{{ $education['college'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Year of Completion</label>
                                                            <input type="text" class="form-control" name="education_year[]" value="{{ $education['year'] }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Experience</h4>
                                <div class="experience-info">
                                    @php
                                        $experiences = old('experience_hospital')
                                            ? collect(old('experience_hospital'))->map(function ($item, $index) {
                                                return [
                                                    'hospital_name' => old('experience_hospital')[$index] ?? '',
                                                    'from' => old('experience_from')[$index] ?? '',
                                                    'to' => old('experience_to')[$index] ?? '',
                                                    'designation' => old('experience_designation')[$index] ?? '',
                                                ];
                                            })
                                            : (isset($doctor) && $doctor->experiences && $doctor->experiences->count()
                                                ? $doctor->experiences->map(fn($e) => [
                                                    'hospital_name' => $e->hospital_name,
                                                    'from' => $e->from,
                                                    'to' => $e->to,
                                                    'designation' => $e->designation,
                                                ])
                                                : collect([['hospital_name' => '', 'from' => '', 'to' => '', 'designation' => '']]));
                                    @endphp

                                    @foreach($experiences as $experience)
                                        <div class="row form-row experience-cont">
                                            <div class="col-12 col-md-10 col-lg-11">
                                                <div class="row form-row">
                                                    <div class="col-12 col-md-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Hospital Name</label>
                                                            <input type="text" class="form-control" name="experience_hospital[]" value="{{ $experience['hospital_name'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>From</label>
                                                            <input type="text" class="form-control" name="experience_from[]" value="{{ $experience['from'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>To</label>
                                                            <input type="text" class="form-control" name="experience_to[]" value="{{ $experience['to'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Designation</label>
                                                            <input type="text" class="form-control" name="experience_designation[]" value="{{ $experience['designation'] }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Awards</h4>
                                <div class="awards-info">
                                    @php
                                        $awards = old('award_name')
                                            ? collect(old('award_name'))->map(function ($item, $index) {
                                                return [
                                                    'award' => old('award_name')[$index] ?? '',
                                                    'year' => old('award_year')[$index] ?? '',
                                                ];
                                            })
                                            : (isset($doctor) && $doctor->awards && $doctor->awards->count()
                                                ? $doctor->awards->map(fn($a) => [
                                                    'award' => $a->award,
                                                    'year' => $a->year,
                                                ])
                                                : collect([['award' => '', 'year' => '']]));
                                    @endphp

                                    @foreach($awards as $award)
                                        <div class="row form-row awards-cont">
                                            <div class="col-12 col-md-5">
                                                <div class="form-group">
                                                    <label>Awards</label>
                                                    <input type="text" class="form-control" name="award_name[]" value="{{ $award['award'] }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-5">
                                                <div class="form-group">
                                                    <label>Year</label>
                                                    <input type="text" class="form-control" name="award_year[]" value="{{ $award['year'] }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Memberships</h4>
                                <div class="membership-info">
                                    @php
                                        $memberships = old('membership_name')
                                            ? collect(old('membership_name'))->map(fn($m) => ['membership' => $m])
                                            : (isset($doctor) && $doctor->memberships && $doctor->memberships->count()
                                                ? $doctor->memberships->map(fn($m) => ['membership' => $m->membership])
                                                : collect([['membership' => '']]));
                                    @endphp

                                    @foreach($memberships as $membership)
                                        <div class="row form-row membership-cont">
                                            <div class="col-12 col-md-10 col-lg-5">
                                                <div class="form-group">
                                                    <label>Memberships</label>
                                                    <input type="text" class="form-control" name="membership_name[]" value="{{ $membership['membership'] }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Registrations</h4>
                                <div class="registrations-info">
                                    @php
                                        $registrations = old('registration_name')
                                            ? collect(old('registration_name'))->map(function ($item, $index) {
                                                return [
                                                    'registration' => old('registration_name')[$index] ?? '',
                                                    'year' => old('registration_year')[$index] ?? '',
                                                ];
                                            })
                                            : (isset($doctor) && $doctor->registrations && $doctor->registrations->count()
                                                ? $doctor->registrations->map(fn($r) => [
                                                    'registration' => $r->registration,
                                                    'year' => $r->year,
                                                ])
                                                : collect([['registration' => '', 'year' => '']]));
                                    @endphp

                                    @foreach($registrations as $registration)
                                        <div class="row form-row reg-cont">
                                            <div class="col-12 col-md-5">
                                                <div class="form-group">
                                                    <label>Registrations</label>
                                                    <input type="text" class="form-control" name="registration_name[]" value="{{ $registration['registration'] }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-5">
                                                <div class="form-group">
                                                    <label>Year</label>
                                                    <input type="text" class="form-control" name="registration_year[]" value="{{ $registration['year'] }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="submit-section submit-btn-bottom">
                            <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="{{ asset('front-end/assets/js/jquery.min.js') }}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{ asset('front-end/assets/js/popper.min.js') }}"></script>
		<script src="{{ asset('front-end/assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="{{ asset('front-end/assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{ asset('front-end/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
		
		<!-- Select2 JS -->
		<script src="{{ asset('front-end/assets/plugins/select2/js/select2.min.js') }}"></script>
		
		<!-- Dropzone JS -->
		<script src="{{ asset('front-end/assets/plugins/dropzone/dropzone.min.js') }}"></script>
		
		<!-- Bootstrap Tagsinput JS -->
		<script src="{{ asset('front-end/assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"></script>
		
		<!-- Profile Settings JS -->
		<script src="{{ asset('front-end/assets/js/profile-settings.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{ asset('front-end/assets/js/script.js') }}"></script>
		
	</body>

<!-- doccure/doctor-profile-settings.html  30 Nov 2019 04:12:15 GMT -->
</html>
