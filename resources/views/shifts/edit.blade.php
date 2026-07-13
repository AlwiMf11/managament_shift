@extends('layouts.app')

@section('title', 'Edit Jadwal Shift')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bold mb-0">Edit Jadwal Shift</h3>
        <p class="text-muted mb-0">Perbarui jadwal shift {{ $shift->employee->name }}.</p>
    </div>

    <div class="card card-stat">
        <div class="card-body">
            <form action="{{ route('shifts.update', $shift) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="employee_id" class="form-label">Karyawan</label>
                    <select name="employee_id" id="employee_id" class="form-select @error('employee_id') is-invalid @enderror">
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ old('employee_id', $shift->employee_id) == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }} ({{ $employee->department }})
                            </option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="shift_name" class="form-label">Nama Shift</label>
                    <select name="shift_name" id="shift_name" class="form-select @error('shift_name') is-invalid @enderror">
                        <option value="">-- Pilih Shift --</option>
                        @foreach (['Pagi', 'Siang', 'Malam'] as $option)
                            <option value="{{ $option }}" {{ old('shift_name', $shift->shift_name) == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                    @error('shift_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', \Carbon\Carbon::parse($shift->date)->format('Y-m-d')) }}">
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_time" class="form-label">Jam Mulai</label>
                        <input type="time" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time', \Carbon\Carbon::parse($shift->start_time)->format('H:i')) }}">
                        @error('start_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_time" class="form-label">Jam Selesai</label>
                        <input type="time" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time', \Carbon\Carbon::parse($shift->end_time)->format('H:i')) }}">
                        @error('end_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('shifts.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
