# BAB 1 PENDAHULUAN

## Latar Belakang
Seleksi penerima beasiswa akademik merupakan salah satu agenda penting yang dilakukan oleh perguruan tinggi untuk memberikan bantuan finansial sekaligus penghargaan kepada mahasiswa yang memiliki prestasi akademik dan non-akademik, serta membutuhkan bantuan secara ekonomi. Proses seleksi yang dilakukan secara manual seringkali menghadapi kendala seperti subjektivitas penilai, ketidakkonsistenan dalam pembobotan, serta waktu evaluasi yang cukup lama. Oleh karena itu, dibutuhkan sebuah Sistem Pendukung Keputusan (Decision Support System / DSS) yang dapat membantu pihak kampus dalam melakukan penilaian secara komprehensif, cepat, transparan, dan tepat sasaran.

## Rumusan Masalah
Berdasarkan latar belakang tersebut, rumusan masalah yang diselesaikan oleh sistem ini adalah:
1. Bagaimana cara meminimalkan subjektivitas dalam seleksi penerima beasiswa akademik?
2. Bagaimana cara mengintegrasikan kriteria akademik (seperti IPK) dan kriteria ekonomi (seperti penghasilan orang tua dan tanggungan) ke dalam satu perhitungan yang baku?
3. Bagaimana merancang dan membangun sistem pendukung keputusan yang dapat menghasilkan rekomendasi calon penerima beasiswa akademik terbaik secara otomatis berdasarkan data yang diinput?

## Tujuan Sistem
Tujuan utama dari sistem ini adalah:
1. Membantu pihak kampus melakukan proses seleksi penerima beasiswa akademik secara objektif, transparan, konsisten, dan berdasarkan data.
2. Menerapkan metode Simple Additive Weighting (SAW) untuk pembobotan dan penilaian kriteria.
3. Menyediakan antarmuka yang mudah digunakan bagi pengelola data untuk menginputkan data mahasiswa, kriteria, dan nilai.

## Manfaat Sistem
Manfaat dari pengembangan sistem pendukung keputusan ini antara lain:
1. Meningkatkan efisiensi waktu dalam proses rekapitulasi nilai dan perhitungan seleksi penerima beasiswa akademik.
2. Meningkatkan akuntabilitas dan transparansi dalam proses seleksi karena seluruh perhitungan didasarkan pada metode matematika yang jelas.
3. Memberikan rekomendasi daftar calon penerima beasiswa (Top Kandidat) secara instan kepada pihak pengambil keputusan.

---

# BAB 2 ANALISIS SISTEM

## Gambaran Umum Sistem
Sistem ini berbasis web dan dikembangkan menggunakan framework Laravel. Sistem ini mengelola data mahasiswa, kriteria penilaian (seperti IPK, Penghasilan Orang Tua, Tanggungan Anak, dan Prestasi Non-Akademik), serta nilai masing-masing mahasiswa terhadap setiap kriteria. Sistem kemudian memproses nilai tersebut menggunakan algoritma Simple Additive Weighting (SAW) untuk menghasilkan perangkingan calon penerima beasiswa.

## Analisis Proses Bisnis
1. **Pendataan Kriteria:** Tim Seleksi mendefinisikan kriteria yang akan dinilai beserta bobot masing-masing dan menentukan apakah kriteria tersebut berjenis 'benefit' (semakin besar semakin baik, misal IPK) atau 'cost' (semakin kecil semakin baik, misal Penghasilan Orang Tua).
2. **Pendataan Mahasiswa:** Admin mendaftarkan calon penerima beasiswa, baik secara manual (input satu per satu) maupun dengan cara mengimpor data melalui file Excel.
3. **Pengisian Penilaian:** Admin mengisi nilai untuk masing-masing calon penerima beasiswa pada setiap kriteria yang telah ditentukan.
4. **Proses DSS (Perhitungan SAW):** Sistem secara otomatis memproses nilai tersebut: melakukan normalisasi matriks keputusan, kemudian mengalikan nilai normalisasi dengan bobot kriteria.
5. **Perangkingan:** Sistem mengurutkan mahasiswa berdasarkan nilai akhir tertinggi dan merekomendasikan daftar mahasiswa yang paling layak menerima beasiswa akademik.

## Analisis Kebutuhan Fungsional
1. Sistem harus dapat menampilkan Dashboard yang memuat ringkasan data dan top 3 calon penerima beasiswa.
2. Sistem harus menyediakan modul manajemen (CRUD) Kriteria Penilaian.
3. Sistem harus menyediakan modul manajemen (CRUD) dan fitur import untuk Data Mahasiswa.
4. Sistem harus menyediakan halaman khusus untuk menginputkan / mengubah Nilai Penilaian Mahasiswa secara massal (grid view).
5. Sistem harus memiliki modul Perhitungan (Calculation) yang menampilkan matriks keputusan awal, hasil normalisasi matriks, hasil preferensi akhir, dan daftar ranking rekomendasi penerima beasiswa.

## Analisis Kebutuhan Non Fungsional
1. **Kinerja (Performance):** Perhitungan SAW harus dilakukan secara cepat dan menampilkan hasil secara instan.
2. **Keandalan (Reliability):** Sistem harus memastikan bahwa total bobot dihitung dan diproses dengan benar.
3. **Ketersediaan (Availability):** Sistem berbasis web yang dapat diakses kapan saja oleh admin/pengguna.
4. **Antarmuka Pengguna (UI/UX):** Sistem dibangun menggunakan antarmuka yang modern, responsif, dan mudah dipahami dengan bantuan Tailwind CSS.

---

# BAB 3 PERANCANGAN SISTEM

Dalam proses perancangan sistem, digunakan beberapa pendekatan pemodelan untuk menggambarkan sistem secara lebih detail. Rincian selengkapnya terdapat pada file dokumen terkait:
1. **Use Case Diagram:** Menggambarkan interaksi antara aktor (seperti Admin) dengan sistem. Rincian pada [use_case.md](use_case.md).
2. **Flowchart:** Menggambarkan alur kerja utama aplikasi dari input data hingga hasil ranking rekomendasi beasiswa. Rincian pada [flowchart.md](flowchart.md).
3. **Activity Diagram:** Menjelaskan secara lebih spesifik langkah-langkah aktivitas pada proses penilaian. Rincian pada [activity_diagram.md](activity_diagram.md).
4. **Sequence Diagram:** Menunjukkan urutan interaksi antar objek atau komponen sistem (Controller, Model, Database) dalam waktu tertentu. Rincian pada [sequence_diagram.md](sequence_diagram.md).
5. **Entity Relationship Diagram (ERD):** Menggambarkan relasi antar entitas database (Students, Criteria, Assessments). Rincian pada [erd.md](erd.md).
6. **Database Design:** Struktur rinci dari masing-masing tabel di dalam database. Rincian pada [database_design.md](database_design.md).
7. **Arsitektur Sistem:** Desain arsitektur aplikasi MVC (Model-View-Controller) menggunakan Laravel. Rincian pada [arsitektur_sistem.md](arsitektur_sistem.md).

---

# BAB 4 IMPLEMENTASI

## Struktur Project
Implementasi sistem menggunakan struktur framework Laravel. Routing diatur dalam `routes/web.php`. Controller mengatur logika pemrosesan yang berada dalam direktori `app/Http/Controllers`. Model untuk entitas berada dalam `app/Models`. Tampilan antarmuka berada dalam `resources/views`. Penjelasan rinci tentang folder dan file sistem diuraikan pada [struktur_project.md](struktur_project.md).

## Implementasi Modul
Modul utama diimplementasikan ke dalam beberapa kontroler, antara lain:
- **`DssController`:** Mengelola perhitungan metode SAW untuk seleksi beasiswa dan menyuplai data untuk halaman Dashboard serta halaman hasil Perhitungan.
- **`StudentController`:** Mengelola fitur input, edit, hapus, dan import data Excel untuk mahasiswa.
- **`CriterionController`:** Mengelola penentuan kriteria penilaian, bobot, dan tipe kriteria (Benefit/Cost).
- **`AssessmentController`:** Mengelola input penilaian masing-masing mahasiswa terhadap setiap kriteria dalam format matriks.

## Implementasi Database
Database yang digunakan dirancang secara relasional. Terdapat tabel `students` untuk data mahasiswa, `criteria` untuk data kriteria, dan `assessments` untuk nilai persimpangan antara mahasiswa dan kriteria (memiliki relasi *many-to-many* antara mahasiswa dan kriteria). Implementasi lengkap berdasarkan file migrasi Laravel dijabarkan pada [database_design.md](database_design.md).

## Implementasi DSS
Sistem mengimplementasikan metode SAW untuk seleksi penerima beasiswa akademik. Proses perhitungan dilakukan secara *on-the-fly* pada fungsi `calculateSAW()` dalam `DssController`. Algoritma mencari nilai min/max pada tiap kriteria, menormalisasi data berdasarkan tipe kriteria (cost/benefit), mengalikan nilai normalisasi dengan bobot, lalu memunculkan total skor (preferensi).

---

# BAB 5 KESIMPULAN
Sistem Pendukung Keputusan (DSS) Rekomendasi Penerima Beasiswa Akademik ini berhasil dikembangkan menggunakan framework Laravel dengan penerapan algoritma Simple Additive Weighting (SAW). Berdasarkan hasil reverse engineering dari source code, dapat disimpulkan bahwa:
1. Sistem telah memenuhi seluruh fungsi yang diperlukan untuk melakukan pendataan, penilaian, dan perangkingan secara transparan untuk seleksi penerima beasiswa.
2. Algoritma SAW diimplementasikan secara dinamis, sehingga memungkinkan admin untuk merubah bobot maupun jenis kriteria tanpa harus merombak kode program.
3. Desain database yang sederhana namun efektif menjamin konsistensi data yang diperlukan oleh proses perhitungan sistem pendukung keputusan rekomendasi beasiswa akademik.
