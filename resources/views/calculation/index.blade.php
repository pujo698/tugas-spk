@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between items-center mb-4 border-b pb-3">
    <h2 class="h3 font-bold text-gray-800">Hasil Perhitungan DSS (Metode SAW)</h2>
    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali</a>
</div>

@if(count($students) == 0)
    <div class="alert alert-warning shadow-sm border-l-4 border-yellow-500" role="alert">
        <strong>Perhatian!</strong> Data mahasiswa atau nilai belum tersedia. Silakan masukkan data melalui Database Seeder atau tambahkan fitur input.
    </div>
@else

<!-- Matriks Awal -->
<div class="card mb-5">
    <div class="card-header bg-white font-semibold text-blue-700">1. Matriks Keputusan Awal (X)</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Mahasiswa</th>
                        @foreach($criteria as $c)
                            <th>{{ $c->code }} ({{ $c->name }})</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td class="font-medium">{{ $student->name }} <span class="text-sm text-gray-500">({{ $student->nim }})</span></td>
                            @foreach($criteria as $c)
                                <td>{{ $matrix[$student->id][$c->id] ?? 0 }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Matriks Ternormalisasi -->
<div class="card mb-5">
    <div class="card-header bg-white font-semibold text-blue-700">2. Matriks Ternormalisasi (R)</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Mahasiswa</th>
                        @foreach($criteria as $c)
                            <th>{{ $c->code }} ({{ ucfirst($c->type) }})</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td class="font-medium">{{ $student->name }}</td>
                            @foreach($criteria as $c)
                                <td>{{ number_format($normalizedMatrix[$student->id][$c->id] ?? 0, 2) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Hasil Akhir -->
<div class="card mb-4 shadow-lg border-primary">
    <div class="card-header bg-primary text-white font-bold text-lg">3. Hasil Akhir & Perangkingan (V)</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="text-center">Peringkat</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nilai Preferensi Akhir</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($finalScores as $index => $result)
                        <tr class="{{ $index == 0 ? 'table-success' : '' }}">
                            <td class="text-center font-bold text-lg">{{ $index + 1 }}</td>
                            <td>{{ $result['student']->nim }}</td>
                            <td class="font-semibold">{{ $result['student']->name }}</td>
                            <td class="font-mono text-lg">{{ number_format($result['score'], 4) }}</td>
                            <td>
                                @if($index == 0)
                                    <span class="badge bg-success px-3 py-2 rounded-pill">Direkomendasikan</span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2 rounded-pill">Tidak Direkomendasikan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endif
@endsection
