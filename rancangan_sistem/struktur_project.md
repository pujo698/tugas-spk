# Struktur Project

Sistem ini dikembangkan menggunakan framework Laravel dengan arsitektur MVC (Model-View-Controller). Berikut adalah analisis seluruh struktur folder dan file penting yang menyusun sistem ini.

## Root Directory

Struktur utama project pada level *root* mengikuti standar bawaan Laravel:

* `app/` : Menyimpan kode inti dari aplikasi (Controller, Model, dan struktur inti aplikasi).
* `bootstrap/` : Menyimpan file-file framework dan konfigurasi *cache* untuk mempercepat *loading* aplikasi.
* `config/` : Menyimpan seluruh file konfigurasi aplikasi (seperti pengaturan database, session, file systems).
* `database/` : Menyimpan file untuk migrasi (schema database), *seeder* (pengisian data awal), dan pabrik data (*factories*).
* `public/` : Menjadi direktori utama (Document Root) yang diakses dari web server. Menyimpan `index.php` dan berbagai aset statis (CSS, JS, gambar).
* `resources/` : Menyimpan file *view* aplikasi (Blade template) serta sumber mentah aset frontend.
* `routes/` : Menyimpan semua definisi routing atau jalur URL aplikasi.
* `storage/` : Menyimpan file hasil kompilasi Blade, session, cache berbasis file, dan file lain yang dihasilkan sistem (*logs*, unggahan file).
* `tests/` : Menyimpan *script* pengujian (*unit tests* dan *feature tests*).
* `artisan` : Program antarmuka baris perintah (CLI) yang disediakan oleh Laravel untuk membantu proses *development*.
* `composer.json` : File konfigurasi Composer yang mendeklarasikan paket (*dependencies*) PHP yang dibutuhkan oleh sistem.
* `package.json` : File konfigurasi NPM yang mendeklarasikan dependensi aset *frontend* (Tailwind, Vite, dll).

---

## Analisis Folder Penting (Modul Inti)

### 1. Folder `app/Models`
Direktori ini berisi representasi objek dari entitas database yang digunakan sistem.

* **`Student.php`**: Model untuk entitas Mahasiswa. Memiliki relasi `hasMany` ke tabel Penilaian (`assessments`).
* **`Criterion.php`**: Model untuk entitas Kriteria Penilaian.
* **`Assessment.php`**: Model untuk entitas Penilaian. Menjadi tabel perantara dan menyimpan nilai setiap mahasiswa pada kriteria tertentu.
* **`User.php`**: Model bawaan untuk otentikasi (meskipun fitur login mungkin belum diimplementasikan/aktif digunakan di modul yang ada, file ini adalah standar bawaan Laravel).

### 2. Folder `app/Http/Controllers`
Direktori ini menampung *Controller* yang berfungsi sebagai penghubung antara Model dan View. Di sinilah logika bisnis (termasuk algoritma DSS) berjalan.

* **`StudentController.php`**: Menangani permintaan (request) CRUD untuk Data Mahasiswa. Juga mengelola fungsi import mahasiswa dari Excel.
* **`CriterionController.php`**: Menangani permintaan CRUD untuk Data Kriteria.
* **`AssessmentController.php`**: Menangani proses penyimpanan data nilai matriks (evaluasi mahasiswa terhadap tiap kriteria).
* **`DssController.php`**: Controller krusial yang menampung implementasi Algoritma Simple Additive Weighting (SAW). Menghasilkan data untuk *Dashboard* dan halaman perhitungan/ranking.

### 3. Folder `database/migrations`
Direktori ini menampung skema versi untuk merancang dan mengubah struktur database.

* `2026_06_09_010530_create_criteria_table.php` : Skema tabel Kriteria (`criteria`).
* `2026_06_09_010530_create_students_table.php` : Skema tabel Mahasiswa (`students`).
* `2026_06_09_010531_create_assessments_table.php` : Skema tabel Penilaian (`assessments`).

### 4. Folder `database/seeders`
Direktori ini memuat kelas untuk mengisi data contoh (*dummy data* / *initial data*) secara massal ke database.

* **`DatabaseSeeder.php`**: Memasukkan data awal berupa beberapa sampel Mahasiswa, Kriteria, dan Penilaian untuk keperluan pengujian dan demonstrasi sistem.

### 5. Folder `routes`
* **`web.php`**: Mengatur seluruh rute aplikasi berbasis web yang bisa diakses pengguna. Menghubungkan URL ke *controller* dan *method* masing-masing (misal URL `/calculation` diarahkan ke `DssController@calculation`).

### 6. Folder `resources/views`
Direktori ini berisi kode presentasi (antarmuka / UI) menggunakan Blade.

* `dashboard.blade.php`: Tampilan beranda dan ringkasan Top 3 Ranking.
* `students/`: Kumpulan file UI untuk entitas Mahasiswa (`index.blade.php`, `create.blade.php`, `edit.blade.php`).
* `criteria/`: Kumpulan file UI untuk entitas Kriteria (`index.blade.php`, `create.blade.php`, `edit.blade.php`).
* `assessments/`: Kumpulan file UI untuk mengatur matriks penilaian.
* `calculation/`: Kumpulan file UI untuk melihat laporan proses perhitungan SAW dan ranking.

## Hubungan Antar Modul

1. **Modul Pengelolaan Data Master (Students & Criteria):**
   * Diatur oleh *Controller* masing-masing. Berjalan secara independen untuk mencatat master data sebelum perhitungan dilakukan.
2. **Modul Penilaian (Assessments):**
   * Sangat bergantung pada data Master. Halaman ini (`AssessmentController`) mengambil seluruh entitas *Student* dan *Criterion* yang aktif untuk dirender sebagai sebuah grid matriks input.
3. **Modul DSS (Calculation & Dashboard):**
   * Bergantung penuh pada ketiga entitas (Students, Criteria, dan Assessments). *DssController* membaca semua data yang telah diinputkan, memproses nilai berdasarkan jenis kriteria (benefit/cost) serta bobotnya menggunakan metode SAW, kemudian mengirimkan hasil *array* yang berisikan urutan calon penerima beasiswa kepada file tampilan (View) untuk ditampilkan.
