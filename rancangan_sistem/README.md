# DSS Penentuan Mahasiswa Berprestasi

## Tujuan Sistem

Sistem Pendukung Keputusan (Decision Support System / DSS) ini dikembangkan untuk membantu pihak akademik dalam menentukan mahasiswa berprestasi secara objektif, terukur, transparan, dan konsisten. Sistem menggunakan metode Simple Additive Weighting (SAW) untuk mengevaluasi setiap mahasiswa berdasarkan berbagai kriteria, baik akademik maupun non-akademik, sehingga dapat menghasilkan rekomendasi mahasiswa terbaik.

## Teknologi

Sistem ini dikembangkan menggunakan teknologi:
* **Framework Backend:** Laravel (PHP)
* **Bahasa Pemrograman:** PHP (>= 8.3)
* **Database:** SQLite (default berdasarkan `.env.example` / `database.sqlite` / konfigurasi standar Laravel 10/11)
* **Frontend:** Blade Templating Engine (Laravel), Tailwind CSS, Vite
* **Library Tambahan:** Maatwebsite Excel (untuk import data mahasiswa)

## Ringkasan Fitur

Berdasarkan analisis source code, sistem ini memiliki fitur-fitur berikut:
1. **Dashboard:** Menampilkan ringkasan statistik (total mahasiswa, kriteria, penilaian) dan top kandidat mahasiswa berprestasi (Top 3).
2. **Manajemen Mahasiswa:** Fitur CRUD (Create, Read, Update, Delete) data mahasiswa, pencarian data mahasiswa, serta import data mahasiswa menggunakan file Excel/CSV.
3. **Manajemen Kriteria:** Fitur CRUD data kriteria penilaian, penentuan tipe kriteria (Benefit/Cost), dan pembobotan kriteria.
4. **Manajemen Penilaian (Assessments):** Fitur untuk menginputkan nilai mahasiswa pada masing-masing kriteria yang telah ditentukan.
5. **Perhitungan DSS & Ranking:** Fitur yang melakukan perhitungan dengan metode Simple Additive Weighting (SAW), menampilkan matriks awal, hasil normalisasi, dan nilai akhir/ranking mahasiswa.

## Struktur Dokumentasi

Dokumentasi ini berisi hasil analisis dan perancangan sistem berdasarkan reverse engineering source code, yang terdiri dari file-file berikut:
- [Laporan Sistem](laporan_sistem.md)
- [Analisis Fitur](analisis_fitur.md)
- [Struktur Project](struktur_project.md)
- [Arsitektur Sistem](arsitektur_sistem.md)
- [Use Case](use_case.md)
- [Flowchart](flowchart.md)
- [Activity Diagram](activity_diagram.md)
- [Sequence Diagram](sequence_diagram.md)
- [Entity Relationship Diagram (ERD)](erd.md)
- [Database Design](database_design.md)
- [Metode DSS](metode_dss.md)
- [Kriteria dan Bobot](kriteria_dan_bobot.md)
- [Perhitungan DSS](perhitungan_dss.md)
- [Rekomendasi Keputusan](rekomendasi_keputusan.md)
- [API Documentation](api_documentation.md)
- [Kesimpulan Analisis](kesimpulan_analisis.md)
