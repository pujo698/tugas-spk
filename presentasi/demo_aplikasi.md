# Panduan Demonstrasi Aplikasi DSS

Dokumen ini berisi panduan langkah demi langkah (*step-by-step*) untuk melakukan demonstrasi secara langsung (*live demo*) dari aplikasi DSS Rekomendasi Penerima Beasiswa Akademik saat sesi presentasi.

Pastikan aplikasi telah dijalankan di *local server* (`php artisan serve`) dan database telah terisi data awal (`php artisan migrate:fresh --seed`) sebelum demonstrasi dimulai.

---

### Langkah 1: Membuka Dashboard Utama
1. Buka browser dan arahkan ke halaman utama aplikasi (biasanya `http://localhost:8000`).
2. Tunjukkan halaman **Dashboard**.
3. **Narasi/Penjelasan:** Tunjukkan kepada audiens *summary cards* yang menampilkan total mahasiswa, total kriteria, dan total penilaian yang ada di dalam sistem. Jelaskan juga bahwa sistem secara otomatis (*real-time*) menampilkan *Top Candidates* (3 Mahasiswa Terbaik) di halaman depan berdasarkan data terkini.

### Langkah 2: Menampilkan Manajemen Kriteria
1. Klik menu navigasi **"Kriteria"**.
2. **Narasi/Penjelasan:** Tunjukkan tabel yang berisi daftar kriteria (IPK, Penghasilan Orang Tua, dll). Perlihatkan kolom "Bobot" dan kolom "Tipe" (*Benefit*/*Cost*).
3. **Aksi Opsional:** Lakukan simulasi menekan tombol "Tambah Kriteria" atau "Edit" untuk membuktikan bahwa sistem bersifat dinamis dan parameter dapat diubah oleh pihak kampus kapan saja.

### Langkah 3: Menampilkan Data Mahasiswa
1. Klik menu navigasi **"Mahasiswa"**.
2. **Narasi/Penjelasan:** Tunjukkan daftar mahasiswa yang menjadi calon penerima beasiswa akademik. Tunjukkan informasi dasar seperti NIM, Nama, dan Program Studi.
3. **Aksi Opsional:** Lakukan simulasi menambahkan satu mahasiswa baru untuk memperlihatkan bahwa aplikasi mendukung pendaftaran atau penambahan data baru.

### Langkah 4: Memasukkan Penilaian (Assessment)
1. Klik menu navigasi **"Penilaian"**.
2. **Narasi/Penjelasan:** Jelaskan bahwa di halaman ini admin akan memasukkan nilai mentah untuk masing-masing kriteria.
3. **Aksi:** Pilih salah satu mahasiswa dari daftar, kemudian klik tombol "Input Nilai". Masukkan angka secara acak yang logis (misal: IPK 3.75, Penghasilan 2500000, dll), lalu simpan.
4. **Penjelasan Tambahan:** Tekankan bahwa yang dimasukkan adalah nilai angka riil (*raw data*), dan sistemlah yang nanti akan memprosesnya.

### Langkah 5: Menjalankan Proses DSS & Laporan Kalkulasi
1. Klik menu navigasi **"Kalkulasi DSS"** atau **"Laporan"** (sesuaikan dengan nama menu di aplikasi).
2. **Narasi/Penjelasan:** Ini adalah inti dari aplikasi DSS. Jelaskan bahwa proses perhitungan algoritma SAW dilakukan secara transparan di halaman ini.
3. **Aksi:**
   - *Scroll* perlahan untuk menunjukkan **Matriks Keputusan Awal** (nilai mentah).
   - *Scroll* ke bagian **Matriks Normalisasi**. Jelaskan secara singkat bagaimana nilai *Cost* dan *Benefit* telah dikonversi menjadi skala 0 hingga 1.
   - *Scroll* ke bagian akhir yaitu **Hasil Preferensi Akhir / Ranking**.
4. **Penjelasan Hasil:** Tunjukkan baris paling atas dari tabel hasil akhir. Sebutkan nama mahasiswa yang berada di peringkat #1 dan skor akhir yang didapat. Jelaskan bahwa mahasiswa tersebut adalah yang paling direkomendasikan sistem secara matematis untuk menerima beasiswa akademik.

### Langkah 6: Penutup Demo
1. Kembali ke halaman **Dashboard**.
2. **Narasi/Penjelasan:** Tunjukkan kembali bahwa widget *Top Candidates* di *Dashboard* kini telah diperbarui (jika tadi Anda melakukan penambahan/perubahan data yang cukup signifikan untuk merubah peringkat).
3. Tutup demonstrasi dengan menyatakan bahwa aplikasi telah berjalan sesuai dengan desain algoritma yang direncanakan.