@extends('admin.maindesign')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Profile</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Account settings</h5>
            <p class="text-muted">Update your name, contact details, email, and optional password.</p>

            @include('profile.partials.profile-form', [
                'user' => $user,
                'inputClass' => 'form-control',
                'labelClass' => 'd-block mb-1',
                'adminLayout' => true,
                'showEmailVerification' => false,
            ])
        </div>
    </div>
@endsection
