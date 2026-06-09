@extends('layouts.admin')

@section('title', 'Data Mahasiswa')

@section('content')

<div class="content-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 24px;">
        <div>
            <h2 style="margin:0; font-size:16px; font-weight:800; color:#1e293b;">Daftar Alternatif (Mahasiswa)</h2>
            <p style="margin:4px 0 0; font-size:12px; color:#64748b;">Kelola data mahasiswa calon penerima beasiswa</p>
        </div>
        
        <div style="display:flex; align-items:center; gap:12px;">
            <form id="search-form" action="{{ route('students.index') }}" method="GET" style="display:flex; align-items:center; position:relative; margin:0;">
                <i data-lucide="search" style="width:14px; height:14px; position:absolute; left:12px; color:#94a3b8;"></i>
                <input type="text" id="search-input" name="search" value="{{ request('search') }}" autocomplete="off" placeholder="Cari mahasiswa..." class="form-input" style="padding-left:34px; padding-top:8px; padding-bottom:8px; width:220px; border-radius:10px; margin:0; font-size:12px;" oninput="debounceSearch()">
                @if(request('search'))
                    <a href="{{ route('students.index') }}" style="position:absolute; right:12px; color:#ef4444; display:flex; align-items:center; justify-content:center;"><i data-lucide="x" style="width:14px; height:14px;"></i></a>
                @endif
            </form>

            <script>
                // Taruh kursor di akhir teks saat halaman dimuat ulang
                document.addEventListener("DOMContentLoaded", function() {
                    const searchInput = document.getElementById('search-input');
                    if (searchInput && searchInput.value) {
                        searchInput.focus();
                        searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
                    }
                });

                let searchTimeout;
                function debounceSearch() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(function() {
                        document.getElementById('search-form').submit();
                    }, 500); // Tunggu 500ms setelah user selesai mengetik
                }
            </script>

            <form id="import-form" action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                @csrf
                <input type="file" name="file" id="import-file" accept=".xlsx, .xls, .csv" onchange="document.getElementById('import-form').submit()">
            </form>
            <button type="button" class="btn-primary" style="padding:9px 16px; background:#10b981; border-color:#10b981;" onclick="document.getElementById('import-file').click()">
                <i data-lucide="file-spreadsheet" style="width:16px; height:16px;"></i> Import Excel
            </button>
            <a href="{{ route('students.create') }}" class="btn-primary" style="padding:9px 16px;">
                <i data-lucide="plus" style="width:16px; height:16px;"></i> Tambah Data
            </a>
        </div>
    </div>

    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Program Studi</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td style="color:#64748b; font-family:monospace;">{{ $student->nim }}</td>
                    <td style="color:#1e293b; font-weight:500;">
                        {{ $student->name }}
                    </td>
                    <td>{{ $student->major }}</td>
                    <td style="text-align:right;">
                        <div style="display:flex; justify-content:flex-end; gap:8px;">
                            <a href="{{ route('students.edit', $student->id) }}" class="btn-icon" style="color:#2563eb; background:transparent;">
                                <i data-lucide="pen"></i>
                            </a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-icon" style="color:#475569; background:#f1f5f9; border:1px solid #e2e8f0;">
                                    <i data-lucide="trash-2"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="empty-state">
                        <i data-lucide="users"></i>
                        <p style="margin:0; font-weight:600;">Belum ada data mahasiswa</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
