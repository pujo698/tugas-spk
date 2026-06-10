# Kriteria dan Bobot

Berdasarkan inisialisasi awal database (`database/seeders/DatabaseSeeder.php`), sistem ini menggunakan empat (4) kriteria utama untuk menentukan kelayakan rekomendasi penerima beasiswa akademik. Kriteria ini telah dibobot berdasarkan tingkat kepentingannya oleh pihak kampus.

Berikut adalah rincian kriteria, bobot, dan sifat yang digunakan:

| Kode | Kriteria | Bobot | Benefit / Cost | Sumber Data (Interpretasi) |
| :---: | -------- | :---: | :------------: | ----------- |
| **C1** | IPK | 0.35 | Benefit | Semakin tinggi Indeks Prestasi Kumulatif, semakin besar poinnya. |
| **C2** | Penghasilan Orang Tua | 0.25 | Cost | Semakin kecil penghasilan orang tua, semakin diprioritaskan untuk mendapat beasiswa akademik. |
| **C3** | Tanggungan Anak | 0.20 | Benefit | Semakin banyak tanggungan anak dari orang tua calon penerima, semakin diprioritaskan. |
| **C4** | Prestasi Non-Akademik | 0.20 | Benefit | Semakin tinggi skor prestasi atau keaktifan mahasiswa, semakin besar poinnya. |

**Total Bobot** = 0.35 + 0.25 + 0.20 + 0.20 = 1.0 (100%).

## Catatan Mengenai Kriteria Tambahan
Sistem didesain dengan konsep **Dinamis**. Meskipun seeder hanya mencontohkan 4 kriteria di atas (IPK, Penghasilan, Tanggungan, Prestasi Non-Akademik), administrator dapat dengan bebas **menambah kriteria baru** (seperti Keaktifan Mahasiswa, Kedisiplinan, dll) secara langsung melalui antarmuka modul "Manajemen Kriteria". Algoritma SAW yang ada dalam `DssController` akan otomatis memproses semua kriteria tanpa perlu perubahan *source code*.
