# Flowchart Proses Sistem

Flowchart di bawah ini menggambarkan alur kerja (workflow) proses utama di dalam Sistem Pendukung Keputusan Pemilihan Mahasiswa Berprestasi dari awal inisialisasi master data hingga menghasilkan laporan akhir.

```mermaid
flowchart TD
    Start([Mulai]) --> InputKriteria["Input Data Kriteria<br/>(Benefit-Cost dan Bobot)"]

    InputKriteria --> InputMahasiswa["Input Data Mahasiswa"]
    InputMahasiswa --> PilihanImport{"Pilih Metode Input?"}

    PilihanImport -->|Manual| FormManual["Isi Form Manual"]
    PilihanImport -->|Import Excel| FileExcel["Upload File Excel"]

    FormManual --> SimpanMhs["Simpan ke Database"]
    FileExcel --> SimpanMhs

    SimpanMhs --> InputNilai["Input Nilai Evaluasi<br/>(Matriks Penilaian)"]
    InputNilai --> DSSProses["Proses Metode DSS SAW"]

    DSSProses --> Matriks["Bentuk Matriks Keputusan"]
    Matriks --> MinMax["Cari Nilai Min/Max tiap Kriteria"]
    MinMax --> Normalisasi["Normalisasi Matriks berdasarkan Tipe Kriteria"]
    Normalisasi --> KaliBobot["Kalikan Normalisasi dengan Bobot Kriteria"]
    KaliBobot --> SumSkor["Jumlahkan Total Skor Preferensi"]
    SumSkor --> SortRanking["Urutkan Mahasiswa berdasarkan Skor"]

    SortRanking --> TampilHasil["Tampilkan Hasil dan Rekomendasi Ranking"]
    TampilHasil --> Laporan["Cetak/Tampilkan Laporan"]
    Laporan --> End([Selesai])
```

## Deskripsi Flowchart
1. **Mulai:** Admin memulai proses seleksi.
2. **Input Kriteria:** Sistem memerlukan kriteria terlebih dahulu sebelum dapat dihubungkan ke penilaian.
3. **Input Mahasiswa:** Admin mengisi data mahasiswa melalui metode manual atau upload Excel.
4. **Input Penilaian:** Berbekal data mahasiswa dan kriteria, admin mengisi matriks nilai masing-masing.
5. **Proses DSS:** Perhitungan otomatis (Metode SAW) berjalan di latar belakang (Bentuk Matriks, Cari Min/Max, Normalisasi, Kali Bobot).
6. **Hasil & Rekomendasi:** Sistem memberikan urutan mahasiswa terbaik (Ranking) yang dapat menjadi acuan keputusan pihak akademik.
