@extends('layouts.admin')

@section('title', 'Data Penilaian')

@section('content')

<div class="content-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 24px;">
        <div>
            <h2 style="margin:0; font-size:16px; font-weight:800; color:#1e293b;">Input Penilaian Mahasiswa</h2>
            <p style="margin:4px 0 0; font-size:12px; color:#64748b;">Masukkan nilai untuk setiap kriteria pada alternatif mahasiswa</p>
        </div>
    </div>

    <form action="{{ route('assessments.store') }}" method="POST">
        @csrf
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th style="width:250px;">Mahasiswa</th>
                        @foreach($criteria as $c)
                            <th>{{ $c->name }} <span style="font-weight:400; font-size:10px; color:#94a3b8;">(C{{ $c->id }})</span></th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                    <tr>
                        <td style="color:#1e293b; font-weight:600;">
                            {{ $student->name }}
                            <div style="font-size:10px; font-weight:400; color:#64748b; margin-top:2px; font-family:monospace;">{{ $student->nim }}</div>
                        </td>
                        @foreach($criteria as $c)
                            @php
                                // Cari nilai jika sudah ada
                                $score = isset($matrix[$student->id][$c->id]) ? $matrix[$student->id][$c->id] : '';
                            @endphp
                            <td>
                                <input type="number" step="0.01" name="values[{{ $student->id }}][{{ $c->id }}]" 
                                    class="form-input" placeholder="0.00" value="{{ $score }}" style="width:90px; padding:6px 10px; text-align:right;">
                            </td>
                        @endforeach
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ count($criteria) + 1 }}" class="empty-state">
                            <i data-lucide="clipboard-list"></i>
                            <p style="margin:0; font-weight:600;">Data mahasiswa / kriteria belum lengkap</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(count($students) > 0 && count($criteria) > 0)
        <div style="margin-top:24px; display:flex; justify-content:flex-end;">
            <button type="submit" class="btn-primary">
                <i data-lucide="save"></i> Simpan Penilaian
            </button>
        </div>
        @endif
    </form>
</div>

@endsection
