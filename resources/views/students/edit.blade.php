@extends('layouts.admin')

@section('title', 'Edit Mahasiswa')

@section('content')

<div class="content-card" style="max-width:600px;">
    <div style="margin-bottom: 24px;">
        <h2 style="margin:0; font-size:16px; font-weight:800; color:#1e293b;">Edit Data Mahasiswa</h2>
        <p style="margin:4px 0 0; font-size:12px; color:#64748b;">Ubah data mahasiswa yang sudah ada di sistem</p>
    </div>

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom:16px;">
            <label for="nim" class="form-label">Nomor Induk Mahasiswa (NIM)</label>
            <input type="text" id="nim" name="nim" class="form-input" required value="{{ old('nim', $student->nim) }}">
        </div>

        <div style="margin-bottom:16px;">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" id="name" name="name" class="form-input" required value="{{ old('name', $student->name) }}">
        </div>

        <div style="margin-bottom:24px;">
            <label for="major" class="form-label">Program Studi</label>
            <input type="text" id="major" name="major" class="form-input" required value="{{ old('major', $student->major) }}">
        </div>

        <div style="display:flex; justify-content:flex-end; gap:12px;">
            <a href="{{ route('students.index') }}" class="btn-primary" style="background:#f1f5f9; color:#475569; box-shadow:none;">Batal</a>
            <button type="submit" class="btn-primary">
                <i data-lucide="save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@endsection
