@extends('admin.maindesign')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Edit Specialty</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.specialties.index') }}">Specialties</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.specialties.update', $specialty) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $specialty->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if ($specialty->image)
                    <div class="form-group">
                        <label>Current Image</label>
                        <div>
                            <img src="{{ asset('storage/' . $specialty->image) }}" alt="{{ $specialty->name }}" width="80" height="80" style="object-fit: cover; border-radius: 6px;">
                        </div>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary"><i class="fa fa-refresh mr-1"></i>Update</button>
                <a href="{{ route('admin.specialties.index') }}" class="btn btn-light"><i class="fa fa-times mr-1"></i>Cancel</a>
            </form>
        </div>
    </div>
@endsection
