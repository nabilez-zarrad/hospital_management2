@extends('admin.maindesign')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Appointments</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Appointments</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-center mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Doctor</th>
                            <th>Patient</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($appointments as $appt)
                            <tr>
                                <td>{{ $appt->id }}</td>
                                <td>{{ $appt->appointment_date?->format('Y-m-d') }}</td>
                                <td>{{ $appt->appointment_time }}</td>
                                <td>
                                    @if ($appt->doctor)
                                        {{ $appt->doctor->first_name }} {{ $appt->doctor->last_name }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>
                                    @if ($appt->patient)
                                        {{ $appt->patient->first_name }} {{ $appt->patient->last_name }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td><span class="badge badge-secondary">{{ $appt->status }}</span></td>
                                <td>{{ number_format((float) $appt->total, 2) }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.appointments.show', $appt) }}" class="btn btn-sm btn-light"><i class="fa fa-eye mr-1"></i>View</a>
                                    <a href="{{ route('admin.appointments.edit', $appt) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil mr-1"></i>Edit</a>
                                    <form action="{{ route('admin.appointments.destroy', $appt) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this appointment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No appointments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($appointments->hasPages())
    <div class="card-footer d-flex justify-content-between align-items-center">

        <!-- عدد النتائج -->
        <div class="text-muted small">
            Showing {{ $appointments->firstItem() }} 
            to {{ $appointments->lastItem() }} 
            of {{ $appointments->total() }} results
        </div>

        <!-- pagination -->
        <div>
            {{ $appointments->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endif
    </div>
@endsection
