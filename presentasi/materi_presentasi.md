# Materi Presentasi UAS Sistem Pendukung Keputusan

Materi berikut disusun untuk presentasi berdurasi 10–15 menit.

### Slide 1 – Judul
* **Judul Sistem:** DSS Rekomendasi Penerima Beasiswa Akademik
* **Nama Anggota Kelompok:** [Nama Anggota 1], [Nama Anggota 2], [Nama Anggota 3]
* **Mata Kuliah:** Sistem Pendukung Keputusan (SPK/DSS)

### Slide 2 – Latar Belakang
* **Permasalahan Seleksi:** Jumlah pendaftar beasiswa akademik seringkali melebihi kuota yang tersedia, sehingga membutuhkan prioritas yang tepat.
* **Kendala Proses Manual:** Proses seleksi konvensional seringkali memakan waktu, rentan terhadap subjektivitas, dan kesulitan dalam mengukur kriteria dengan satuan yang berbeda secara adil.

### Slide 3 – Tujuan Sistem
* **Tujuan Pengembangan DSS:** Membangun Sistem Pendukung Keputusan yang membantu pihak kampus melakukan proses seleksi penerima beasiswa akademik secara objektif, transparan, konsisten, dan sepenuhnya berdasarkan data kuantitatif.

### Slide 4 – Gambaran Umum Sistem
* **Fungsi Utama:** Aplikasi web berbasis Laravel yang mengelola data mahasiswa (alternatif), kriteria penilaian, dan melakukan kalkulasi secara otomatis untuk menghasilkan rekomendasi peringkat penerima beasiswa akademik.
* **Arsitektur:** Menggunakan pola Model-View-Controller (MVC) untuk memisahkan logika perhitungan, manajemen data, dan antarmuka pengguna.

### Slide 5 – Metode DSS yang Digunakan
* **Penjelasan Singkat:** Menggunakan metode **Simple Additive Weighting (SAW)**, atau penjumlahan terbobot.
* **Alasan Penggunaan:** SAW dipilih karena kemampuannya dalam melakukan penilaian secara presisi terhadap kriteria yang memiliki dimensi atau skala berbeda melalui proses normalisasi matriks, sehingga sangat cocok untuk menyeimbangkan nilai akademik (seperti IPK) dengan nilai non-akademik/ekonomi.

### Slide 6 – Kriteria Penilaian
* **Daftar Kriteria dan Atribut:**
  * **C1 - IPK:** Bobot 35%, Atribut *Benefit* (Semakin tinggi semakin baik).
  * **C2 - Penghasilan Orang Tua:** Bobot 25%, Atribut *Cost* (Semakin rendah penghasilan, semakin diprioritaskan).
  * **C3 - Tanggungan Anak:** Bobot 20%, Atribut *Benefit* (Semakin banyak tanggungan, semakin diprioritaskan).
  * **C4 - Prestasi Non-Akademik:** Bobot 20%, Atribut *Benefit* (Semakin tinggi skor prestasi, semakin baik).
* *Catatan: Sistem bersifat dinamis, kriteria dapat ditambah atau diubah oleh admin.*

### Slide 7 – Alur Sistem
* **Ringkasan Flowchart:**
  1. Input Data Mahasiswa (Alternatif).
  2. Input Kriteria dan Bobot Kepentingan.
  3. Input Penilaian (Nilai masing-masing mahasiswa untuk setiap kriteria).
  4. DSS melakukan Ekstraksi Nilai Min/Max tiap kriteria.
  5. DSS melakukan Normalisasi (membentuk matriks rasio 0.0 - 1.0).
  6. DSS mengalikan matriks normalisasi dengan bobot kriteria (Preferensi).
  7. Sistem mengurutkan (ranking) skor total secara menurun (*descending*).

### Slide 8 – Implementasi Aplikasi
* **Fitur Utama Aplikasi:**
  * **Dashboard:** Ringkasan statistik dan tiga kandidat teratas.
  * **Manajemen Kriteria:** Menambah, mengubah, dan menghapus parameter penilaian.
  * **Manajemen Mahasiswa:** Mengelola data calon penerima beasiswa.
  * **Penilaian (Assessment):** Antarmuka input skor mahasiswa.
  * **Kalkulasi & Laporan (Calculation):** Tabel transparan yang memperlihatkan matriks awal, hasil normalisasi, hingga skor akhir.

### Slide 9 – Contoh Perhitungan DSS
* **Ringkasan Proses:**
  * **Matriks Awal:** Mahasiswa A memiliki IPK 3.8 (C1), Penghasilan 3 juta (C2).
  * **Normalisasi Benefit (C1):** Nilai Mahasiswa A (3.8) dibagi Nilai Maksimal IPK dari seluruh pendaftar (misal 3.9).
  * **Normalisasi Cost (C2):** Nilai Minimal Penghasilan dari seluruh pendaftar (misal 1.5 juta) dibagi Penghasilan Mahasiswa A (3 juta).
  * **Nilai Preferensi Akhir:** (Normalisasi C1 × 0.35) + (Normalisasi C2 × 0.25) + ... dan seterusnya.

### Slide 10 – Hasil Ranking
* **Contoh Hasil Rekomendasi:**
  * Sistem akan menampilkan tabel berurut dari skor preferensi tertinggi hingga terendah.
  * Mahasiswa di peringkat pertama (misalnya "Siti Nurhaliza" dengan skor 0.94) secara matematis adalah kandidat paling optimal dan direkomendasikan sistem sebagai penerima beasiswa akademik.

### Slide 11 – Kelebihan Sistem
* **Kelebihan:**
  * Mengeliminasi *human error* dalam perhitungan matematis seleksi.
  * Transparansi: Setiap langkah (matriks, normalisasi, hasil) dapat dilihat, bukan sekadar "black box".
  * Fleksibilitas: Pihak kampus dapat menyesuaikan bobot jika terjadi perubahan kebijakan beasiswa.

### Slide 12 – Kesimpulan
* Implementasi metode SAW dalam aplikasi Laravel ini berhasil mentransformasi proses seleksi beasiswa akademik menjadi proses yang berbasis data (*data-driven*).
* Sistem ini berperan sebagai pendukung komputasi yang sangat andal, memberikan dasar kuantitatif bagi pihak kampus untuk mengambil keputusan final.

### Slide 13 – Terima Kasih
* Sesi Tanya Jawab (Q&A)
* Penutup
