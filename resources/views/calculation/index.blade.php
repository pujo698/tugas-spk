@extends('layouts.admin')

@section('title', 'Hasil Perhitungan SAW')

@section('content')

<div class="content-card" style="margin-bottom:24px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 24px;">
        <div>
            <h2 style="margin:0; font-size:16px; font-weight:800; color:#1e293b;">Matriks Keputusan (X)</h2>
            <p style="margin:4px 0 0; font-size:12px; color:#64748b;">Nilai mentah dari setiap alternatif berdasarkan kriteria</p>
        </div>
    </div>
    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th style="width:250px;">Alternatif</th>
                    @foreach($criteria as $c)
                        <th style="text-align:right;">C{{ $c->id }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($matrix as $studentId => $scores)
                <tr>
                    <td style="color:#1e293b; font-weight:600;">{{ $students->find($studentId)->name }}</td>
                    @foreach($criteria as $c)
                        <td style="text-align:right; color:#475569;">{{ number_format($scores[$c->id] ?? 0, 2) }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="content-card" style="margin-bottom:24px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 24px;">
        <div>
            <h2 style="margin:0; font-size:16px; font-weight:800; color:#1e293b;">Matriks Ternormalisasi (R)</h2>
            <p style="margin:4px 0 0; font-size:12px; color:#64748b;">Membagi/membagikan dengan nilai max/min sesuai jenis kriteria</p>
        </div>
    </div>
    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th style="width:250px;">Alternatif</th>
                    @foreach($criteria as $c)
                        <th style="text-align:right;">C{{ $c->id }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($normalizedMatrix as $studentId => $scores)
                <tr>
                    <td style="color:#1e293b; font-weight:600;">{{ $students->find($studentId)->name }}</td>
                    @foreach($criteria as $c)
                        <td style="text-align:right; color:#475569;">{{ number_format($scores[$c->id] ?? 0, 4) }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="content-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 24px;">
        <div>
            <h2 style="margin:0; font-size:16px; font-weight:800; color:#1e293b;">Hasil Akhir & Perankingan</h2>
            <p style="margin:4px 0 0; font-size:12px; color:#64748b;">Rekomendasi terbaik berdasarkan nilai akhir tertinggi</p>
        </div>
    </div>
    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th style="width:80px; text-align:center;">Peringkat</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th style="text-align:right;">Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($finalScores as $index => $result)
                <tr @if($index == 0) style="background:#f0fdf4;" @endif>
                    <td style="text-align:center;">
                        @if($index == 0)
                            <span class="badge badge-green" style="font-size:14px;">🥇 1</span>
                        @elseif($index == 1)
                            <span class="badge badge-amber" style="font-size:12px;">🥈 2</span>
                        @elseif($index == 2)
                            <span class="badge badge-amber" style="font-size:12px; background:#fff7ed; color:#c2410c;">🥉 3</span>
                        @else
                            <span style="font-weight:700; color:#94a3b8;">{{ $index + 1 }}</span>
                        @endif
                    </td>
                    <td style="color:#1e293b; font-weight:600;">{{ $result['student']->name }}</td>
                    <td style="color:#64748b; font-family:monospace;">{{ $result['student']->nim }}</td>
                    <td style="text-align:right; font-weight:800; color:#1e293b; font-size:14px;">{{ number_format($result['score'], 4) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
