@extends('admin.maindesign')

@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Appointment #{{ $appointment->id }}</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.appointments.index') }}">Appointments</a></li>
                    <li class="breadcrumb-item active">Details</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.appointments.edit', $appointment) }}" class="btn btn-primary"><i class="fa fa-pencil mr-1"></i>Edit</a>
                <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this appointment?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p><strong>Date:</strong> {{ $appointment->appointment_date?->format('Y-m-d') }}</p>
            <p><strong>Time:</strong> {{ $appointment->appointment_time }}</p>
            <p><strong>Status:</strong> {{ $appointment->status }}</p>
            <p><strong>Total:</strong> {{ number_format((float) $appointment->total, 2) }}</p>
            <hr>
            <p><strong>Doctor:</strong>
                @if ($appointment->doctor)
                    {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}
                    @if ($appointment->doctor->user)
                        ({{ $appointment->doctor->user->email }})
                    @endif
                @else
                    —
                @endif
            </p>
            <p><strong>Patient:</strong>
                @if ($appointment->patient)
                    {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}
                    @if ($appointment->patient->user)
                        ({{ $appointment->patient->user->email }})
                    @endif
                @else
                    —
                @endif
            </p>
        </div>
    </div>
@endsection
