@extends('layouts.patient')

@section('content')
    @include('patient.header')

    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('patient.dashboard') }}">Home</a></li>
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
                @include('patient.sidbar')

                <div class="col-md-7 col-lg-8 col-xl-9">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
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

                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="row form-row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="change-avatar">
                                                <div class="profile-img">
                                                    <img src="{{ auth()->user()->patient?->profile_image_url ?? asset('front-end/assets/img/patients/patient.jpg') }}" alt="Patient Image">
                                                </div>
                                                <div class="upload-img">
                                                    <div class="change-photo-btn">
                                                        <span><i class="fa fa-upload"></i> Upload Photo</span>
                                                        <input type="file" class="upload" name="image" accept=".jpg,.jpeg,.png,.webp">
                                                    </div>
                                                    <small class="form-text text-muted">Allowed JPG, PNG, WEBP. Max size 2MB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $user->mobile) }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', optional($user->patient?->date_of_birth)->format('Y-m-d')) }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" name="city" class="form-control" value="{{ old('city', $user->patient?->city) }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" name="country" class="form-control" value="{{ old('country', $user->patient?->country) }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>New Password (optional)</label>
                                            <input type="password" name="password" class="form-control" autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>

                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
