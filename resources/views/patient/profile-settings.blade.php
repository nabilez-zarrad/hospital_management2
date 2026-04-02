@extends('layouts.patient')

@section('content')
    @include('components.premium-dashboard-styles')
    @include('patient.header')

    <style>
        .settings-shell {
            max-width: none;
            margin: 0;
        }

        .settings-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .settings-card .card-body {
            padding: 14px;
        }

        .settings-card .form-control {
            height: 40px;
            border-radius: 9px;
            border-color: #dbe3ef;
            font-size: 14px;
        }

        .settings-card textarea.form-control {
            height: auto;
            min-height: 90px;
            resize: vertical;
        }

        .settings-card label {
            font-size: 14px;
            margin-bottom: 5px;
            font-weight: 600;
            color: #334155;
        }

        .settings-card .submit-btn {
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            padding: 8px 14px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border: 0;
        }

        .settings-card .submit-btn:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
        }

        .change-avatar .profile-img img {
            width: 78px;
            height: 78px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid #dbe3ef;
        }
    </style>

    <div class="content">
        <div class="container-fluid settings-shell">
            <div class="premium-hero mb-3">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>Profile Settings</h2>
                        <p>Update your personal details and account information.</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('patient.dashboard') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i>Back To Dashboard
                        </a>
                    </div>
                </div>
            </div>
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

                    <div class="card settings-card">
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
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label>Blood Type</label>
                                            @php($bloodType = old('blood_type', $user->patient?->blood_type))
                                            <select name="blood_type" class="form-control">
                                                <option value="">Select blood type</option>
                                                @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                                                    <option value="{{ $type }}" @selected($bloodType === $type)>{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Allergies</label>
                                            <textarea name="allergies" class="form-control" placeholder="e.g. Penicillin, peanuts">{{ old('allergies', $user->patient?->allergies) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Medical Notes</label>
                                            <textarea name="medical_notes" class="form-control" placeholder="Any chronic conditions, surgeries, or important notes">{{ old('medical_notes', $user->patient?->medical_notes) }}</textarea>
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
