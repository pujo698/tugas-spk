# Analisis Fitur Sistem

Berikut adalah seluruh fitur yang tersedia pada Sistem Pendukung Keputusan Rekomendasi Penerima Beasiswa Akademik, berdasarkan hasil analisis terhadap _source code_ aktual.

| No | Fitur | Deskripsi | Modul |
| -- | ----- | --------- | ----- |
| 1 | **Dashboard** | Menampilkan ringkasan data sistem (Total Mahasiswa, Total Kriteria, Total Penilaian) dan menampilkan rekomendasi Top 3 Calon Penerima Beasiswa secara langsung. | `DssController@dashboard` |
| 2 | **Lihat Data Mahasiswa** | Menampilkan daftar seluruh mahasiswa yang terdaftar di dalam sistem, dilengkapi dengan fitur pencarian berdasarkan Nama, NIM, atau Jurusan. | `StudentController@index` |
| 3 | **Tambah Mahasiswa** | Menambahkan data mahasiswa baru (NIM, Nama, Jurusan) ke dalam database. | `StudentController@create`, `@store` |
| 4 | **Ubah Mahasiswa** | Memperbarui data mahasiswa yang sudah ada di sistem. | `StudentController@edit`, `@update` |
| 5 | **Hapus Mahasiswa** | Menghapus data mahasiswa dari sistem. | `StudentController@destroy` |
| 6 | **Import Data Mahasiswa** | Memasukkan data mahasiswa secara massal menggunakan file Excel (.xlsx, .xls) atau CSV. | `StudentController@import` |
| 7 | **Lihat Data Kriteria** | Menampilkan daftar seluruh kriteria penilaian, lengkap dengan Kode, Nama, Tipe (Benefit/Cost), dan Bobot, serta dilengkapi dengan fitur pencarian. | `CriterionController@index` |
| 8 | **Tambah Kriteria** | Menambahkan kriteria penilaian baru ke dalam sistem. | `CriterionController@create`, `@store` |
| 9 | **Ubah Kriteria** | Memperbarui data kriteria penilaian yang sudah ada di sistem. | `CriterionController@edit`, `@update` |
| 10 | **Hapus Kriteria** | Menghapus data kriteria penilaian dari sistem. | `CriterionController@destroy` |
| 11 | **Lihat Matriks Penilaian** | Menampilkan grid data penilaian berupa tabel matriks yang mengaitkan setiap mahasiswa dengan seluruh kriteria yang ada. | `AssessmentController@index` |
| 12 | **Simpan/Ubah Penilaian Massal** | Menginput atau memperbarui nilai evaluasi tiap mahasiswa pada masing-masing kriteria secara massal dalam satu halaman (Save Matrix). | `AssessmentController@store` |
| 13 | **Perhitungan DSS (SAW)** | Melakukan kalkulasi menggunakan algoritma Simple Additive Weighting (SAW) secara sistem, meliputi penentuan nilai min/max, proses normalisasi matriks, dan penghitungan nilai preferensi untuk seleksi beasiswa. | `DssController@calculateSAW` |
| 14 | **Lihat Hasil Perhitungan (Ranking)** | Menampilkan detail hasil perhitungan DSS berupa Matriks Keputusan Awal, Matriks Normalisasi, dan Hasil Akhir Perangkingan calon penerima beasiswa dari nilai tertinggi ke terendah. | `DssController@calculation` |
