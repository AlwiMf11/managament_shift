@extends('layouts.app')

@section('title', 'Jadwal Shift')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Jadwal Shift</h3>
            <p class="text-muted mb-0">Atur pembagian shift lebih rapi untuk seluruh karyawan.</p>
        </div>
        <a href="{{ route('shifts.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Jadwal
        </a>
    </div>

    <div class="card card-stat">
        <div class="card-body">
            @if ($shifts->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-calendar-week"></i>
                    Belum ada jadwal shift. Silakan tambahkan jadwal baru.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Karyawan</th>
                                <th>Departemen</th>
                                <th>Shift</th>
                                <th>Jam Kerja</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shifts as $shift)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($shift->date)->translatedFormat('d M Y') }}</td>
                                    <td>{{ $shift->employee->name }}</td>
                                    <td>{{ $shift->employee->department }}</td>
                                    <td>
                                        @php
                                            $badge = match($shift->shift_name) {
                                                'Pagi' => 'bg-info',
                                                'Siang' => 'bg-warning text-dark',
                                                'Malam' => 'bg-dark',
                                                default => 'bg-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $badge }}">{{ $shift->shift_name }}</span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($shift->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($shift->end_time)->format('H:i') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('shifts.edit', $shift) }}" class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('shifts.destroy', $shift) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jadwal shift ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
