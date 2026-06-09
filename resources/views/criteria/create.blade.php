@extends('layouts.admin')

@section('title', 'Tambah Kriteria')

@section('content')

<div class="content-card" style="max-width:600px;">
    <div style="margin-bottom: 24px;">
        <h2 style="margin:0; font-size:16px; font-weight:800; color:#1e293b;">Form Kriteria Penilaian</h2>
        <p style="margin:4px 0 0; font-size:12px; color:#64748b;">Tambahkan kriteria baru untuk perhitungan SAW</p>
    </div>

    <form action="{{ route('criteria.store') }}" method="POST">
        @csrf
        <div style="margin-bottom:16px;">
            <label for="name" class="form-label">Nama Kriteria</label>
            <input type="text" id="name" name="name" class="form-input" required placeholder="Contoh: IPK" value="{{ old('name') }}">
        </div>

        <div style="margin-bottom:16px;">
            <label for="weight" class="form-label">Bobot Kriteria (%)</label>
            <input type="number" step="0.01" id="weight" name="weight" class="form-input" required placeholder="Contoh: 20" value="{{ old('weight') }}">
        </div>

        <div style="margin-bottom:24px;">
            <label for="type" class="form-label">Jenis Atribut</label>
            <select id="type" name="type" class="form-input form-select" required>
                <option value="benefit" {{ old('type') == 'benefit' ? 'selected' : '' }}>Benefit (Semakin besar semakin baik)</option>
                <option value="cost" {{ old('type') == 'cost' ? 'selected' : '' }}>Cost (Semakin kecil semakin baik)</option>
            </select>
        </div>

        <div style="display:flex; justify-content:flex-end; gap:12px;">
            <a href="{{ route('criteria.index') }}" class="btn-primary" style="background:#f1f5f9; color:#475569; box-shadow:none;">Batal</a>
            <button type="submit" class="btn-primary">
                <i data-lucide="save"></i> Simpan Kriteria
            </button>
        </div>
    </form>
</div>

@endsection
