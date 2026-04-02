@extends('admin.maindesign')

@section('content')
    @php
        $doctors = $doctorsCount ?? 0;
        $patients = $patientsCount ?? 0;
        $appointments = $appointmentsCount ?? 0;
        $specialties = $specialtiesCount ?? 0;

        $totalAppointments = max($appointments, 1);
        $statusConfig = [
            'pending' => ['label' => 'Pending', 'color' => '#f59e0b'],
            'approved' => ['label' => 'Approved', 'color' => '#0ea5e9'],
            'cancelled' => ['label' => 'Cancelled', 'color' => '#ef4444'],
            'completed' => ['label' => 'Completed', 'color' => '#10b981'],
        ];
    @endphp

    <style>
        .admin-hero {
            border-radius: 18px;
            background: linear-gradient(135deg, #0b132b 0%, #1c2541 45%, #3a506b 100%);
            color: #fff;
            padding: 26px 28px;
            box-shadow: 0 20px 45px rgba(11, 19, 43, 0.28);
            margin-bottom: 24px;
        }

        .admin-hero h4 {
            margin-bottom: 8px;
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .admin-hero .muted {
            color: rgba(255, 255, 255, 0.78);
            margin-bottom: 0;
        }

        .admin-stat-card {
            border: 0;
            border-radius: 16px;
            padding: 18px;
            height: 100%;
            background: #fff;
            box-shadow: 0 12px 25px rgba(15, 23, 42, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .admin-stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 28px rgba(15, 23, 42, 0.13);
        }

        .admin-stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 18px;
        }

        .admin-stat-title {
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.9px;
            color: #64748b;
            margin-bottom: 5px;
        }

        .admin-stat-value {
            font-size: 34px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1;
            margin-bottom: 0;
        }

        .admin-panel {
            border: 0;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 12px 25px rgba(15, 23, 42, 0.08);
        }

        .admin-panel .card-title {
            font-weight: 700;
            color: #0f172a;
        }

        .admin-btn {
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 0.2px;
            padding: 8px 14px;
            border-width: 0;
            transition: transform 0.18s ease, box-shadow 0.18s ease, opacity 0.18s ease;
        }

        .admin-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(15, 23, 42, 0.16);
            opacity: 0.96;
        }

        .admin-btn i {
            margin-right: 7px;
        }

        .admin-btn-soft {
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.35);
        }

        .admin-btn-soft:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.24);
        }

        .admin-btn-light {
            background: #fff;
            color: #0f172a;
        }

        .admin-btn-light:hover {
            color: #0f172a;
        }

        .admin-btn-primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #fff;
        }

        .admin-btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
        }

        .admin-btn-warning {
            background: linear-gradient(135deg, #f59e0b, #ea580c);
            color: #fff;
        }

        .admin-btn-secondary {
            background: linear-gradient(135deg, #8b5cf6, #6d28d9);
            color: #fff;
        }

        .admin-btn-primary:hover,
        .admin-btn-success:hover,
        .admin-btn-warning:hover,
        .admin-btn-secondary:hover {
            color: #fff;
        }

        .status-row {
            margin-bottom: 16px;
        }

        .status-row:last-child {
            margin-bottom: 0;
        }

        .status-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .status-label {
            color: #334155;
            font-weight: 600;
        }

        .status-count {
            color: #64748b;
            font-weight: 600;
        }

        .status-track {
            width: 100%;
            height: 9px;
            border-radius: 999px;
            background: #e2e8f0;
            overflow: hidden;
        }

        .status-bar {
            height: 100%;
            border-radius: 999px;
        }
    </style>

    <div class="admin-hero">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4>Admin Dashboard</h4>
                <p class="muted">Welcome back, {{ Auth::user()->name }}. Here is a quick snapshot of your hospital operations today.</p>
            </div>
            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                <a href="{{ route('admin.appointments.index') }}" class="btn admin-btn admin-btn-light btn-sm mr-2"><i class="fa fa-calendar-check-o"></i>View Appointments</a>
                <a href="{{ route('admin.doctors.index') }}" class="btn admin-btn admin-btn-soft btn-sm"><i class="fa fa-user-md"></i>Manage Doctors</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="admin-stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="admin-stat-title">Doctors</div>
                        <p class="admin-stat-value">{{ $doctors }}</p>
                    </div>
                    <div class="admin-stat-icon" style="background: linear-gradient(135deg, #0ea5e9, #2563eb);">
                        <i class="fa fa-user-md"></i>
                    </div>
                </div>
                <a href="{{ route('admin.doctors.index') }}" class="btn admin-btn admin-btn-primary btn-sm mt-3"><i class="fa fa-user-md"></i>Manage Doctors</a>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="admin-stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="admin-stat-title">Patients</div>
                        <p class="admin-stat-value">{{ $patients }}</p>
                    </div>
                    <div class="admin-stat-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
                <a href="{{ route('admin.patients.index') }}" class="btn admin-btn admin-btn-success btn-sm mt-3"><i class="fa fa-users"></i>Manage Patients</a>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="admin-stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="admin-stat-title">Appointments</div>
                        <p class="admin-stat-value">{{ $appointments }}</p>
                    </div>
                    <div class="admin-stat-icon" style="background: linear-gradient(135deg, #f59e0b, #ea580c);">
                        <i class="fa fa-calendar-check-o"></i>
                    </div>
                </div>
                <a href="{{ route('admin.appointments.index') }}" class="btn admin-btn admin-btn-warning btn-sm mt-3"><i class="fa fa-calendar-check-o"></i>Manage Appointments</a>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="admin-stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="admin-stat-title">Specialties</div>
                        <p class="admin-stat-value">{{ $specialties }}</p>
                    </div>
                    <div class="admin-stat-icon" style="background: linear-gradient(135deg, #8b5cf6, #6d28d9);">
                        <i class="fa fa-stethoscope"></i>
                    </div>
                </div>
                <a href="{{ route('admin.specialties.index') }}" class="btn admin-btn admin-btn-secondary btn-sm mt-3"><i class="fa fa-stethoscope"></i>Manage Specialties</a>
            </div>
        </div>
    </div>

    <div class="card admin-panel mt-1">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Appointments by Status</h5>
                <span class="badge badge-light p-2">Total Appointments: {{ $appointments }}</span>
            </div>
            @foreach ($statusConfig as $status => $meta)
                @php
                    $count = $appointmentsByStatus[$status] ?? 0;
                    $percentage = min(100, round(($count / $totalAppointments) * 100));
                @endphp
                <div class="status-row">
                    <div class="status-head">
                        <span class="status-label">{{ $meta['label'] }}</span>
                        <span class="status-count">{{ $count }} ({{ $percentage }}%)</span>
                    </div>
                    <div class="status-track">
                        <div class="status-bar" style="width: {{ $percentage }}%; background-color: {{ $meta['color'] }};"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <div class="card admin-panel h-100">
                <div class="card-body">
                    <h6 class="card-title mb-3">Quick Actions</h6>
                    <a href="{{ route('admin.doctors.index') }}" class="btn admin-btn admin-btn-primary btn-block mb-2"><i class="fa fa-user-md"></i>Open Doctors</a>
                    <a href="{{ route('admin.patients.index') }}" class="btn admin-btn admin-btn-success btn-block mb-2"><i class="fa fa-users"></i>Open Patients</a>
                    <a href="{{ route('admin.appointments.index') }}" class="btn admin-btn admin-btn-warning btn-block"><i class="fa fa-calendar"></i>Open Appointments</a>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-3">
            <div class="card admin-panel h-100">
                <div class="card-body">
                    <h6 class="card-title mb-3">System Summary</h6>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="p-3 rounded" style="background: #f8fafc;">
                                <div class="text-muted text-uppercase" style="font-size: 11px;">Operational Capacity</div>
                                <div class="h5 mb-0">{{ $doctors + $specialties }} Resources Active</div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="p-3 rounded" style="background: #f8fafc;">
                                <div class="text-muted text-uppercase" style="font-size: 11px;">Patient Flow</div>
                                <div class="h5 mb-0">{{ $patients }} Patients Registered</div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="p-3 rounded" style="background: #eef2ff; border: 1px solid #c7d2fe;">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-info-circle mr-2" style="color: #4338ca;"></i>
                                    <span style="color: #312e81;">Keep your appointments list updated daily to maintain accurate dashboard analytics.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
