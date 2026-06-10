# Ringkasan Proyek (Untuk AI Briefing)

*Dokumen ini disusun khusus sebagai konteks sumber bagi NotebookLM untuk memahami proyek aplikasi web "DSS Rekomendasi Penerima Beasiswa Akademik".*

# Ringkasan Sistem
Proyek ini adalah pengembangan Sistem Pendukung Keputusan (DSS) berbasis *web* menggunakan *framework* Laravel (Arsitektur MVC). Fungsi utama aplikasi ini adalah untuk menyeleksi dan memberikan rekomendasi peringkat bagi calon penerima beasiswa akademik berdasarkan sekumpulan parameter/kriteria kuantitatif.

# Tujuan Sistem
Tujuan sistem ini adalah menyelesaikan masalah penilaian manual yang lambat dan subjektif. DSS ini membantu pihak kampus (manajemen/admin) mengambil keputusan secara lebih transparan, objektif, cepat, dan berdasarkan perhitungan matematis (*data-driven*).

# Metode DSS
Sistem ini menggunakan metode algoritma **Simple Additive Weighting (SAW)**. Logika ini ditanamkan pada `DssController.php`. SAW dipilih karena kemampuannya membandingkan (normalisasi) nilai antar kriteria yang memiliki metrik/skala ukuran berbeda.

# Kriteria Penilaian
Sistem bersifat dinamis (kriteria dapat ditambah/dihapus via *database*). Namun sebagai *default*, terdapat 4 kriteria:
1. **IPK**: Bobot 35%, atribut *Benefit* (makin besar makin baik).
2. **Penghasilan Orang Tua**: Bobot 25%, atribut *Cost* (makin kecil makin baik/diprioritaskan).
3. **Tanggungan Anak**: Bobot 20%, atribut *Benefit*.
4. **Prestasi Non-Akademik**: Bobot 20%, atribut *Benefit*.
Total bobot kriteria adalah 1.0 (100%).

# Alur Perhitungan
1. **Data Awal**: Sistem mengumpulkan nilai mentah (*assessment*) setiap mahasiswa pada seluruh kriteria.
2. **Ekstraksi**: Mencari nilai minimum dan maksimum dari setiap kriteria tersebut.
3. **Normalisasi**: Membagi nilai mentah dengan nilai max/min (tergantung atribut benefit/cost) sehingga berubah menjadi rasio skala 0.0 hingga 1.0.
4. **Preferensi Akhir**: Rasio normalisasi dikalikan dengan bobot kriteria, kemudian dijumlahkan seluruhnya.

# Implementasi Sistem
Sistem ini dibangun dengan PHP 8.x (Laravel) dan *database* relasional (SQLite/MySQL). Fitur yang tersedia bagi pengguna meliputi: *Dashboard* Ringkasan, Manajemen Kriteria (CRUD), Manajemen Mahasiswa (CRUD), Form Penilaian, dan Halaman Laporan Kalkulasi.

# Hasil yang Dihasilkan Sistem
Keluaran akhir (output) dari sistem ini bukanlah sebuah keputusan mutlak, melainkan **Rekomendasi Keputusan**. Hasil disajikan dalam bentuk tabel peringkat (*ranking*) yang diurutkan secara menurun (*descending*) berdasarkan skor preferensi akhir tertinggi. Peringkat 1 adalah kandidat paling optimal untuk mendapatkan beasiswa akademik secara matematis.

# Kesimpulan
Aplikasi DSS Rekomendasi Penerima Beasiswa Akademik ini berhasil mentransformasi data mentah yang kompleks dengan skala berbeda-beda menjadi satu kesatuan nilai preferensi akhir yang mudah dibaca oleh pihak pengambil keputusan, mengeliminasi bias manusiawi dalam proses kalkulasi.