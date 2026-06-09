@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<style>
    .db-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 24px;
    }
    
    .db-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        border: 1px solid #f1f5f9;
        overflow: hidden;
        position: relative;
    }

    .db-greeting {
        margin-bottom: 24px;
    }
    .db-greeting h2 {
        font-size: 20px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 4px 0;
    }
    .db-greeting p {
        font-size: 13px;
        color: #64748b;
        margin: 0;
    }

    /* Card Types */
    .card-welcome {
        grid-column: span 4;
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        border: none;
    }
    .card-stats {
        grid-column: span 3;
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 16px;
    }
    .card-square {
        grid-column: span 2;
        background: #3730a3;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: white;
        padding: 24px;
        border: none;
    }
    .card-weather {
        grid-column: span 3;
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        padding: 24px;
        color: white;
        display: flex;
        flex-direction: column;
        border: none;
    }
    .card-list {
        grid-column: span 5;
        padding: 24px;
    }
    .card-circle {
        grid-column: span 3;
        padding: 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .card-gradient {
        grid-column: span 4;
        background: linear-gradient(135deg, #ec4899 0%, #a855f7 100%);
        padding: 32px 24px;
        color: white;
        border: none;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Small components */
    .stat-row {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .stat-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .stat-info h4 {
        margin: 0;
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
    }
    .stat-info p {
        margin: 0;
        font-size: 11px;
        color: #64748b;
    }

    .weather-top {
        font-size: 13px;
        font-weight: 600;
        opacity: 0.9;
    }
    .weather-temp {
        font-size: 42px;
        font-weight: 800;
        margin-top: 12px;
        line-height: 1;
    }
    .weather-bottom {
        margin-top: auto;
        display: flex;
        justify-content: flex-end;
    }
    .weather-icon {
        width: 48px;
        height: 48px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(4px);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .list-title {
        font-size: 14px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 16px 0;
    }
    .list-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .list-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    .list-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 18px;
    }
    .list-text flex-1 { flex: 1; }
    .list-text h5 { margin: 0; font-size: 13px; font-weight: 700; color: #1e293b; }
    .list-text p { margin: 0; font-size: 11px; color: #64748b; }
    .list-value { font-size: 13px; font-weight: 800; color: #1e293b; }

    .circle-wrap {
        position: relative;
        width: 120px;
        height: 120px;
    }
    .circle-wrap svg {
        width: 100%;
        height: 100%;
        transform: rotate(-90deg);
    }
    .circle-bg {
        fill: none;
        stroke: #f1f5f9;
        stroke-width: 8;
    }
    .circle-progress {
        fill: none;
        stroke: #f97316;
        stroke-width: 8;
        stroke-linecap: round;
        transition: stroke-dashoffset 1s ease-out;
    }
    .circle-text {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .circle-text span {
        font-size: 24px;
        font-weight: 800;
        color: #1e293b;
    }
    .circle-title {
        font-size: 13px;
        font-weight: 700;
        color: #1e293b;
        margin-top: 16px;
    }

    .grad-title {
        font-size: 13px;
        font-weight: 600;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .grad-value {
        font-size: 48px;
        font-weight: 800;
        margin: 8px 0;
        line-height: 1;
    }
    .grad-sub {
        font-size: 13px;
        opacity: 0.9;
        background: rgba(255,255,255,0.2);
        padding: 6px 12px;
        border-radius: 8px;
        display: inline-block;
        align-self: flex-start;
    }

    @media (max-width: 1024px) {
        .card-welcome, .card-stats, .card-square, .card-weather, .card-list, .card-circle, .card-gradient {
            grid-column: span 12;
        }
    }
</style>

<div class="db-greeting">
    <h2>Halo Admin, selamat datang kembali 👋</h2>
    <p>Overview Sistem Pendukung Keputusan</p>
</div>

<div class="db-grid">

    {{-- 1. Welcome Card (Illustration replacement) --}}
    <div class="db-card card-welcome">
        <h3 style="margin:0; font-size:18px; font-weight:800; color:#0369a1; line-height:1.3;">Sistem Pendukung<br>Keputusan Beasiswa</h3>
        <p style="margin:8px 0 16px; font-size:12px; color:#0c4a6e;">Kelola data mahasiswa dan kriteria penilaian untuk menghasilkan rekomendasi terbaik.</p>
        <div style="width:32px; height:32px; background:#0284c7; border-radius:8px; display:flex; align-items:center; justify-content:center; margin-top:auto;">
            <i data-lucide="plus" style="color:white; width:16px; height:16px;"></i>
        </div>
    </div>

    {{-- 2. Stats List --}}
    <div class="db-card card-stats">
        <div class="stat-row">
            <div class="stat-icon" style="background:#e0e7ff; color:#4f46e5;"><i data-lucide="users"></i></div>
            <div class="stat-info">
                <h4>{{ $totalStudents }} Mahasiswa</h4>
                <p>Total Pendaftar Aktif</p>
            </div>
        </div>
        <div class="stat-row">
            <div class="stat-icon" style="background:#dcfce7; color:#16a34a;"><i data-lucide="sliders-horizontal"></i></div>
            <div class="stat-info">
                <h4>{{ $totalCriteria }} Kriteria</h4>
                <p>Parameter Penilaian</p>
            </div>
        </div>
    </div>

    {{-- 3. Dark Square --}}
    <div class="db-card card-square">
        <div style="width:48px; height:48px; background:#4f46e5; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-bottom:12px;">
            <i data-lucide="calculator" style="width:24px; height:24px; color:#f8fafc;"></i>
        </div>
        <div style="font-size:14px; font-weight:700;">Metode</div>
        <div style="font-size:24px; font-weight:800; margin-top:4px;">SAW</div>
    </div>

    {{-- 4. Weather-style Card (Data Penilaian) --}}
    <div class="db-card card-weather">
        <div class="weather-top">Data Penilaian Masuk</div>
        <div class="weather-temp">{{ $totalAssessments }}</div>
        <div class="weather-bottom">
            <div class="weather-icon">
                <i data-lucide="clipboard-check" style="width:24px; height:24px;"></i>
            </div>
        </div>
    </div>

    {{-- 5. List Updates (Top Kandidat) --}}
    <div class="db-card card-list">
        <h3 class="list-title">Top Kandidat Beasiswa</h3>
        <div>
            @php
                $colors = ['#10b981', '#f59e0b', '#8b5cf6'];
            @endphp
            @forelse(array_slice($topCandidates, 0, 3) as $index => $candidate)
                <div class="list-item">
                    <div class="list-icon" style="background: {{ $colors[$index] }};">
                        {{ $index + 1 }}
                    </div>
                    <div class="list-text" style="flex:1;">
                        <h5>{{ $candidate['student']->name }}</h5>
                        <p>{{ $candidate['student']->nim }} · {{ $candidate['student']->major }}</p>
                    </div>
                    <div class="list-value">{{ number_format($candidate['score'], 4) }}</div>
                </div>
            @empty
                <div style="text-align:center; padding:20px; color:#94a3b8; font-size:13px;">Belum ada data penilaian.</div>
            @endforelse
        </div>
    </div>

    {{-- 6. Circular Progress --}}
    @php
        $percentage = ($totalStudents > 0 && $totalCriteria > 0)
            ? min(100, round(($totalAssessments / ($totalStudents * $totalCriteria)) * 100))
            : 0;
        $dasharray = 2 * 3.14159 * 42;
        $dashoffset = $dasharray * (1 - $percentage / 100);
    @endphp
    <div class="db-card card-circle">
        <div class="circle-wrap">
            <svg viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="42" class="circle-bg"></circle>
                <circle cx="50" cy="50" r="42" class="circle-progress"
                    stroke-dasharray="{{ $dasharray }}"
                    stroke-dashoffset="{{ $dashoffset }}"></circle>
            </svg>
            <div class="circle-text">
                <span>{{ $percentage }}%</span>
            </div>
        </div>
        <div class="circle-title">Kelengkapan Data</div>
    </div>

    {{-- 7. Gradient Card (Best Candidate Score / Value) --}}
    <div class="db-card card-gradient">
        @if($bestCandidate)
            <div class="grad-title">Nilai Tertinggi</div>
            <div class="grad-value">{{ number_format($bestCandidate['score'], 4) }}</div>
            <div class="grad-sub">{{ $bestCandidate['student']->name }}</div>
        @else
            <div class="grad-title">Nilai Tertinggi</div>
            <div class="grad-value">0.000</div>
            <div class="grad-sub">Belum ada kandidat</div>
        @endif
    </div>

</div>

@endsection
