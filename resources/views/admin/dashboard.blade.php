@extends('admin.maindesign')

@section('content')
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">Admin Dashboard</h4>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted">Doctors</h6>
                    <div class="display-4">{{ $doctorsCount ?? 0 }}</div>
                    <a href="{{ route('admin.doctors.index') }}" class="btn btn-sm btn-outline-primary mt-2">Manage doctors</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted">Patients</h6>
                    <div class="display-4">{{ $patientsCount ?? 0 }}</div>
                    <a href="{{ route('admin.patients.index') }}" class="btn btn-sm btn-outline-primary mt-2">Manage patients</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted">Appointments</h6>
                    <div class="display-4">{{ $appointmentsCount ?? 0 }}</div>
                    <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-outline-primary mt-2">Manage appointments</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted">Specialties</h6>
                    <div class="display-4">{{ $specialtiesCount ?? 0 }}</div>
                    <a href="{{ route('admin.specialties.index') }}" class="btn btn-sm btn-outline-primary mt-2">Manage specialties</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title mb-3">Appointments by Status</h5>
            <div class="row">
                @foreach (['pending','approved','cancelled','completed'] as $status)
                    <div class="col-md-3 mb-2">
                        <div class="p-3 border rounded">
                            <div class="text-uppercase text-muted" style="font-size: 12px;">{{ $status }}</div>
                            <div class="h3 mb-0">{{ ($appointmentsByStatus[$status] ?? 0) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
