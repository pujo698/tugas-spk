@extends('layouts.app')

@section('content')
<div class="hero-section text-center">
    <h1 class="display-4 fw-bold mb-3">Sistem Pendukung Keputusan (DSS)</h1>
    <p class="lead mb-0">Rekomendasi Penerima Beasiswa Akademik dengan Metode Simple Additive Weighting (SAW)</p>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card h-100 p-4">
            <h3 class="h4 text-blue-700 font-semibold mb-3 border-b pb-2">1. Latar Belakang Masalah</h3>
            <p class="text-gray-600 text-justify">
                Proses seleksi penerima beasiswa seringkali melibatkan banyak kriteria dan pelamar, sehingga panitia seleksi kesulitan untuk menentukan kandidat terbaik secara objektif dan cepat. Sistem manual rentan terhadap bias dan kesalahan manusia.
            </p>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card h-100 p-4">
            <h3 class="h4 text-blue-700 font-semibold mb-3 border-b pb-2">2. Tujuan Aplikasi DSS</h3>
            <p class="text-gray-600 text-justify">
                Membangun sebuah Sistem Pendukung Keputusan (DSS) yang transparan, akurat, dan efisien untuk merekomendasikan mahasiswa mana yang paling berhak menerima beasiswa akademik berdasarkan kriteria yang telah ditetapkan.
            </p>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card h-100 p-4">
            <h3 class="h4 text-blue-700 font-semibold mb-3 border-b pb-2">3. Kriteria dan Alternatif</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Nama Kriteria</th>
                            <th>Atribut</th>
                            <th>Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>C1</td><td>IPK</td><td>Benefit</td><td>35%</td></tr>
                        <tr><td>C2</td><td>Penghasilan Orang Tua</td><td>Cost</td><td>25%</td></tr>
                        <tr><td>C3</td><td>Tanggungan Anak</td><td>Benefit</td><td>20%</td></tr>
                        <tr><td>C4</td><td>Prestasi Non-Akademik</td><td>Benefit</td><td>20%</td></tr>
                    </tbody>
                </table>
            </div>
            <p class="text-sm text-gray-500 mt-2"><strong>Alternatif:</strong> Mahasiswa yang mendaftar beasiswa.</p>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card h-100 p-4">
            <h3 class="h4 text-blue-700 font-semibold mb-3 border-b pb-2">4. Metode DSS: SAW</h3>
            <p class="text-gray-600 text-justify">
                Metode <strong>Simple Additive Weighting (SAW)</strong> atau metode penjumlahan terbobot. Konsep dasar metode SAW adalah mencari penjumlahan terbobot dari rating kinerja pada setiap alternatif pada semua atribut.
            </p>
            <ul class="list-disc pl-5 text-gray-600 mt-2">
                <li>Menentukan kriteria dan bobot.</li>
                <li>Membentuk matriks keputusan awal (X).</li>
                <li>Melakukan normalisasi matriks (R) berdasarkan tipe atribut (Benefit/Cost).</li>
                <li>Menghitung hasil akhir (V) dengan mengalikan matriks R dengan bobot.</li>
            </ul>
        </div>
    </div>
</div>

<div class="text-center mt-10">
    <a href="{{ route('calculation') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-lg hover:bg-blue-700 transition">Lihat Hasil Perhitungan DSS &rarr;</a>
</div>
@endsection
