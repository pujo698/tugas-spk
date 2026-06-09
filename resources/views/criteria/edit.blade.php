@extends('layouts.admin')

@section('title', 'Edit Kriteria')

@section('content')

<div class="content-card" style="max-width:600px;">
    <div style="margin-bottom: 24px;">
        <h2 style="margin:0; font-size:16px; font-weight:800; color:#1e293b;">Edit Kriteria Penilaian</h2>
        <p style="margin:4px 0 0; font-size:12px; color:#64748b;">Ubah nama, bobot, atau jenis atribut kriteria</p>
    </div>

    <form action="{{ route('criteria.update', $criterion->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div style="margin-bottom:16px;">
            <label for="name" class="form-label">Nama Kriteria</label>
            <input type="text" id="name" name="name" class="form-input" required value="{{ old('name', $criterion->name) }}">
        </div>

        <div style="margin-bottom:16px;">
            <label for="weight" class="form-label">Bobot Kriteria (%)</label>
            <input type="number" step="0.01" id="weight" name="weight" class="form-input" required value="{{ old('weight', $criterion->weight) }}">
        </div>

        <div style="margin-bottom:24px;">
            <label for="type" class="form-label">Jenis Atribut</label>
            <select id="type" name="type" class="form-input form-select" required>
                <option value="benefit" {{ old('type', $criterion->type) == 'benefit' ? 'selected' : '' }}>Benefit (Semakin besar semakin baik)</option>
                <option value="cost" {{ old('type', $criterion->type) == 'cost' ? 'selected' : '' }}>Cost (Semakin kecil semakin baik)</option>
            </select>
        </div>

        <div style="display:flex; justify-content:flex-end; gap:12px;">
            <a href="{{ route('criteria.index') }}" class="btn-primary" style="background:#f1f5f9; color:#475569; box-shadow:none;">Batal</a>
            <button type="submit" class="btn-primary">
                <i data-lucide="save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@endsection
