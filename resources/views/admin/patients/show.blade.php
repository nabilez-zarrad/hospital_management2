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

        .admin-detail-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 25px rgba(15, 23, 42, 0.08);
        }

        .admin-detail-card .card-header {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .admin-detail-card .card-header h5 {
            font-weight: 700;
            color: #0f172a;
        }

        .admin-detail-card p {
            margin-bottom: 10px;
        }
    </style>

    <div class="page-header admin-hero-lite">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Patient #{{ $patient->id }}</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.patients.index') }}">Patients</a></li>
                    <li class="breadcrumb-item active">Details</li>
                </ul>
            </div>
            <div class="col-auto">
                <form action="{{ route('admin.patients.destroy', $patient) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this patient?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card admin-detail-card">
                <div class="card-header"><h5 class="mb-0">Profile</h5></div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $patient->first_name }} {{ $patient->last_name }}</p>
                    <p><strong>Email:</strong> {{ $patient->user->email ?? '-' }}</p>
                    <p><strong>Phone:</strong> {{ $patient->phone ?? '-' }}</p>
                    <p><strong>Date of birth:</strong> {{ $patient->date_of_birth ?? '-' }}</p>
                    <p><strong>City:</strong> {{ $patient->city ?? '-' }}</p>
                    <p><strong>Country:</strong> {{ $patient->country ?? '-' }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card admin-detail-card">
                <div class="card-header"><h5 class="mb-0">Recent appointments</h5></div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Doctor</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($patient->appointments as $appt)
                                    <tr>
                                        <td>{{ $appt->appointment_date?->format('Y-m-d') }} {{ $appt->appointment_time }}</td>
                                        <td>
                                            @if ($appt->doctor)
                                                {{ $appt->doctor->first_name }} {{ $appt->doctor->last_name }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td><span class="badge badge-info">{{ $appt->status }}</span></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted">No appointments.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
