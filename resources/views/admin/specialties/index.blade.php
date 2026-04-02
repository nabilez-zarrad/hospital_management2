@extends('admin.maindesign')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Specialties</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Specialties</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Specialties</h5>
            <a href="{{ route('admin.specialties.create') }}" class="btn btn-primary"><i class="fa fa-plus mr-1"></i>Add Specialty</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-center mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($specialties as $specialty)
                            <tr>
                                <td>{{ $specialty->name }}</td>
                                <td>
                                    @if ($specialty->image)
                                        <img src="{{ asset('storage/' . $specialty->image) }}" alt="{{ $specialty->name }}" width="60" height="60" style="object-fit: cover; border-radius: 6px;">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('admin.specialties.edit', $specialty) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil mr-1"></i>Edit</a>
                                    <form action="{{ route('admin.specialties.destroy', $specialty) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this specialty?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">No specialties found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($specialties->hasPages())
            <div class="card-footer">{{ $specialties->links() }}</div>
        @endif
    </div>
@endsection
