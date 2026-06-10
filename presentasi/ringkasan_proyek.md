# Ringkasan Proyek: DSS Rekomendasi Penerima Beasiswa Akademik

## 1. Latar Belakang
Setiap institusi pendidikan tinggi umumnya menyediakan program beasiswa akademik untuk membantu para mahasiswanya. Namun, pendaftar beasiswa seringkali melampaui kuota yang disediakan oleh pihak kampus. Hal ini memunculkan kebutuhan akan proses seleksi yang ketat dan adil.
Selama ini, metode seleksi konvensional seringkali memunculkan kendala, terutama dalam komparasi data. Tim penyeleksi kesulitan memberikan penilaian yang obyektif karena faktor yang dinilai (kriteria) memiliki dimensi dan skala ukur yang sangat berbeda; misalnya membandingkan indeks prestasi (skala 4.0) dengan penghasilan keluarga (skala jutaan Rupiah). Kendala komputasi manual ini rentan terhadap *human error* dan unsur subjektivitas.

## 2. Tujuan Sistem
Sistem Pendukung Keputusan (DSS) ini dikembangkan dengan tujuan untuk menjadi alat bantu komputasi bagi pihak kampus. Tujuan utamanya adalah melakukan proses kalkulasi seleksi secara objektif, transparan, konsisten, dan sepenuhnya berbasis data kuantitatif (*data-driven*). Sistem ini tidak menggantikan peran manusia dalam mengambil keputusan final, melainkan menyajikan rekomendasi matematis yang kuat.

## 3. Metode Pendukung Keputusan (DSS)
Metode yang diterapkan dalam proyek ini adalah algoritma **Simple Additive Weighting (SAW)**.
Metode ini sangat populer dalam sistem pendukung keputusan karena prosesnya yang ringkas namun menghasilkan tingkat presisi yang tinggi. Konsep utama SAW adalah melakukan penjumlahan terbobot dari *rating* kinerja setiap alternatif (mahasiswa) pada seluruh kriteria.
Langkah paling krusial dalam SAW adalah proses **Normalisasi**, di mana nilai mentah dari setiap mahasiswa dikonversi ke dalam skala rasio 0.0 hingga 1.0, sehingga semua kriteria dapat dibandingkan secara *apple-to-apple*.

## 4. Kriteria Penilaian
Dalam implementasinya (yang diatur dalam *seeder database* aplikasi), sistem ini mengevaluasi mahasiswa berdasarkan 4 kriteria prioritas:
1. **IPK (C1)**: Bobot 35%. Berupa kriteria *Benefit* (semakin besar nilainya, semakin direkomendasikan).
2. **Penghasilan Orang Tua (C2)**: Bobot 25%. Berupa kriteria *Cost* (semakin kecil nilainya, semakin diprioritaskan untuk dibantu beasiswa).
3. **Tanggungan Anak (C3)**: Bobot 20%. Berupa kriteria *Benefit*.
4. **Prestasi Non-Akademik (C4)**: Bobot 20%. Berupa kriteria *Benefit*.

*Catatan: Sistem dibangun dengan konsep dinamis (CRUD), sehingga administrator dapat menambah, menghapus, atau memodifikasi daftar kriteria di atas menyesuaikan kebijakan kampus yang berlaku.*

## 5. Fitur Utama Aplikasi
Aplikasi ini dikembangkan menggunakan *framework* web **Laravel (PHP)** dengan konsep arsitektur *Model-View-Controller* (MVC). Fitur-fitur utama yang disediakan meliputi:
*   **Dashboard Interaktif**: Menyajikan ringkasan jumlah entitas dan menampilkan secara langsung 3 kandidat terbaik.
*   **Manajemen Master Data**: Modul untuk mengelola data Mahasiswa (sebagai alternatif) dan Kriteria (beserta jenis dan bobotnya).
*   **Modul Penilaian (*Assessment*)**: Antarmuka bagi admin untuk menginput skor mentah masing-masing mahasiswa terhadap setiap kriteria.
*   **Kalkulator DSS Transparan**: Halaman khusus yang membedah proses komputasi. Sistem secara terbuka menampilkan Matriks Keputusan Awal, hasil proses Normalisasi, hingga akhirnya menampilkan Tabel Skor Akhir.

## 6. Hasil Rekomendasi
Keluaran utama atau *output* dari sistem ini adalah tabel **Peringkat (Ranking)**. Sistem akan mengakumulasikan nilai preferensi (hasil kali nilai normalisasi dengan bobot kepentingan) untuk setiap mahasiswa.
Tabel ini diurutkan secara *descending*. Mahasiswa yang berada di peringkat paling atas (Ranking #1) adalah individu yang secara matematis memiliki nilai komulatif paling optimal. Misalnya, ia memiliki keseimbangan terbaik antara IPK yang tinggi dan Penghasilan Orang Tua yang rendah. Hasil inilah yang kemudian diajukan kepada pihak manajemen kampus sebagai **Rekomendasi Penerima Beasiswa Akademik**.