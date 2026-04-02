@extends('admin.maindesign')

@section('content')
    <style>
        .admin-hero-lite {
            border-radius: 16px;
            background: linear-gradient(135deg, #0b132b 0%, #1c2541 45%, #3a506b 100%);
            color: #fff;
            padding: 20px 24px;
            margin-bottom: 18px;
            box-shadow: 0 14px 28px rgba(11, 19, 43, 0.2);
        }

        .admin-hero-lite .page-title {
            color: #fff;
            margin-bottom: 6px;
        }

        .admin-hero-lite .breadcrumb {
            background: transparent;
            margin-bottom: 0;
            padding: 0;
        }

        .admin-hero-lite .breadcrumb-item a,
        .admin-hero-lite .breadcrumb-item.active,
        .admin-hero-lite .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.82);
        }

        .admin-list-card {
            border: 0;
            border-radius: 16px;
            box-shadow: 0 12px 25px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .admin-list-card .table thead th {
            border-top: 0;
            background: #f8fafc;
            color: #334155;
            font-weight: 700;
        }

        .admin-list-card .table td {
            vertical-align: middle;
        }

        .admin-action-btn {
            border-radius: 9px;
            font-weight: 600;
        }
    </style>

    <div class="page-header admin-hero-lite">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Doctors</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Doctors</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card admin-list-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-center mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Speciality</th>
                            <th>Phone</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($doctors as $doctor)
                            <tr>
                                <td>{{ $doctor->id }}</td>
                                <td>{{ $doctor->first_name }} {{ $doctor->last_name }}</td>
                                <td>{{ $doctor->user->email ?? '-' }}</td>
                                <td>{{ $doctor->speciality ?? '-' }}</td>
                                <td>{{ $doctor->phone ?? '-' }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.doctors.show', $doctor) }}" class="btn btn-sm btn-primary admin-action-btn"><i class="fa fa-eye mr-1"></i>View</a>
                                    <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this doctor record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger admin-action-btn"><i class="fa fa-trash mr-1"></i>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No doctors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($doctors->hasPages())
            <div class="card-footer">{{ $doctors->links() }}</div>
        @endif
    </div>
@endsection
