<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Patients</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link href="{{ asset('front-end/assets/img/favicon.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/style.css') }}">
    @include('components.premium-dashboard-styles')
    <style>
        .patient-card {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
            height: 100%;
        }

        .patient-id {
            display: inline-block;
            font-size: 11px;
            background: #eff6ff;
            color: #1e40af;
            border-radius: 999px;
            padding: 4px 10px;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .patient-title {
            font-size: 19px;
            margin-bottom: 8px;
            color: #0f172a;
        }

        .patient-main {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 3px;
        }

        .patient-list {
            margin: 12px 0 0;
            padding: 0;
            list-style: none;
        }

        .patient-list li {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            padding: 6px 0;
            border-bottom: 1px dashed #e5e7eb;
            font-size: 13px;
        }

        .patient-list li:last-child {
            border-bottom: 0;
        }

        .patient-list span:last-child {
            text-align: right;
            color: #0f172a;
            font-weight: 600;
            max-width: 56%;
            overflow-wrap: anywhere;
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    @include('doctor.header')
    <div class="content">
        <div class="container-fluid">
            <div class="premium-hero">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="mb-2 mb-md-0">
                        <h2>My Patients</h2>
                        <p>Quick view of your patient details and medical notes.</p>
                    </div>
                    <span class="badge badge-light px-3 py-2" style="border-radius:999px;font-weight:700;">
                        {{ $patients->count() }} Patients
                    </span>
                </div>
            </div>

            <div class="row">
                @include('doctor.sidbar')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="row row-grid">
                        @forelse($patients as $patient)
                            <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="card patient-card">
                                    <div class="card-body">
                                        <div class="profile-det-info">
                                            <span class="patient-id">P{{ str_pad((string) $patient->id, 4, '0', STR_PAD_LEFT) }}</span>
                                            <h3 class="patient-title">{{ $patient->full_name }}</h3>
                                            <div class="patient-details">
                                                <p class="patient-main mb-0"><i class="fas fa-map-marker-alt mr-1"></i> {{ $patient->location_label }}</p>
                                            </div>
                                        </div>
                                        <div class="patient-info mt-3">
                                            <ul class="patient-list">
                                                <li><span>Phone</span><span>{{ $patient->phone ?: 'Phone number will be updated soon' }}</span></li>
                                                <li><span>Email</span><span>{{ $patient->user?->email ?: 'Email address will be updated soon' }}</span></li>
                                                <li><span>Blood Type</span><span>{{ $patient->blood_type ?: 'Not provided yet' }}</span></li>
                                                <li><span>Allergies</span><span>{{ $patient->allergies ?: 'No allergies provided' }}</span></li>
                                                <li><span>Medical Notes</span><span>{{ $patient->medical_notes ?: 'No medical notes provided' }}</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12"><div class="alert alert-info mb-0">No patients yet.</div></div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('front-end/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('front-end/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('front-end/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front-end/assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
<script src="{{ asset('front-end/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
<script src="{{ asset('front-end/assets/js/script.js') }}"></script>
</body>
</html>
