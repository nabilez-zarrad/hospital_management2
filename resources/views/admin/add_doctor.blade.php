@extends('admin.maindesign')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Add Doctor</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Add Doctor</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('store.doctor') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Password (optional)</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Speciality</label>
                        <input type="text" name="speciality" class="form-control" value="{{ old('speciality') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Specialty</label>
                        <select name="specialty_id" class="form-control">
                            <option value="">Select specialty</option>
                            @foreach($specialties as $specialty)
                                <option value="{{ $specialty->id }}" @selected(old('specialty_id') == $specialty->id)>{{ $specialty->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Price</label>
                        <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price', 0) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Is Free?</label>
                        <select name="is_free" class="form-control">
                            <option value="1" @selected(old('is_free', '1') == '1')>Yes</option>
                            <option value="0" @selected(old('is_free') == '0')>No</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit"><i class="fa fa-plus mr-1"></i>Create Doctor</button>
            </form>
        </div>
    </div>
@endsection
