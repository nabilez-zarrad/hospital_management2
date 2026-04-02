@extends('admin.maindesign')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Edit appointment #{{ $appointment->id }}</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.appointments.index') }}">Appointments</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p class="text-muted">
                {{ $appointment->appointment_date?->format('Y-m-d') }} at {{ $appointment->appointment_time }} —
                @if ($appointment->doctor)
                    Dr. {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}
                @endif
                /
                @if ($appointment->patient)
                    {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}
                @endif
            </p>

            <form action="{{ route('admin.appointments.update', $appointment) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        @foreach (['pending', 'approved', 'cancelled', 'completed'] as $s)
                            <option value="{{ $s }}" @selected(old('status', $appointment->status) === $s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="total">Amount (total)</label>
                    <input type="number" step="0.01" min="0" name="total" id="total" class="form-control @error('total') is-invalid @enderror" value="{{ old('total', $appointment->total) }}">
                    @error('total')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary"><i class="fa fa-check mr-1"></i>Save</button>
                <a href="{{ route('admin.appointments.index') }}" class="btn btn-light"><i class="fa fa-times mr-1"></i>Cancel</a>
            </form>
        </div>
    </div>
@endsection
