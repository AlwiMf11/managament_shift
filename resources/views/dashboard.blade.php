@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bold">Dashboard</h3>
        <p class="text-muted">Kelola jadwal kerja karyawan dengan mudah dan atur pembagian shift lebih rapi.</p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card card-stat h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
                        <i class="bi bi-people fs-3"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Karyawan</div>
                        <div class="fs-3 fw-bold">{{ $totalKaryawan }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stat h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 me-3">
                        <i class="bi bi-calendar-week fs-3"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Jadwal</div>
                        <div class="fs-3 fw-bold">{{ $totalJadwal }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stat h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-3 me-3">
                        <i class="bi bi-sun fs-3"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Shift Hari Ini</div>
                        <div class="fs-3 fw-bold">{{ $shiftHariIni->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-stat">
        <div class="card-header bg-white">
            <strong>Jadwal Shift Hari Ini</strong>
            <span class="text-muted">({{ \Carbon\Carbon::today()->translatedFormat('d F Y') }})</span>
        </div>
        <div class="card-body">
            @if ($shiftHariIni->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-sun"></i>
                    Belum ada jadwal shift untuk hari ini.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Karyawan</th>
                                <th>Departemen</th>
                                <th>Shift</th>
                                <th>Jam Kerja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shiftHariIni as $shift)
                                <tr>
                                    <td>{{ $shift->employee->name }}</td>
                                    <td>{{ $shift->employee->department }}</td>
                                    <td><span class="badge bg-secondary">{{ $shift->shift_name }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($shift->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($shift->end_time)->format('H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
