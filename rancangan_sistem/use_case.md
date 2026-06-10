# Use Case Diagram

## 1. Daftar Actor
Berdasarkan analisis modul aplikasi, sistem saat ini beroperasi dengan asumsi **Single Role** pengguna yang bertugas sebagai pengelola utama sistem. Aktor ini dinamakan:
* **Admin / Tim Seleksi:** Pengguna yang memiliki akses penuh terhadap sistem untuk mengelola data master, mengelola penilaian, dan melihat hasil akhir rekomendasi beasiswa akademik.

## 2. Daftar Use Case
Berikut adalah Use Case yang bisa dilakukan oleh Admin:
1. Mengakses Dashboard
2. Mengelola Data Mahasiswa (CRUD dan Import)
3. Mengelola Data Kriteria (CRUD)
4. Mengelola Penilaian Mahasiswa
5. Melihat Hasil Perhitungan DSS (SAW)
6. Proses Seleksi Penerima Beasiswa

## 3. Deskripsi Use Case

| Nama Use Case | Actor | Deskripsi |
| ------------- | ----- | --------- |
| **Mengakses Dashboard** | Admin | Admin masuk ke halaman utama aplikasi yang menampilkan statistik singkat data dan melihat langsung top 3 calon penerima beasiswa hasil rekomendasi algoritma. |
| **Mengelola Data Mahasiswa** | Admin | Admin dapat menambah, mengubah, melihat detail, menghapus, atau melakukan import data mahasiswa calon penerima beasiswa melalui file Excel. |
| **Mengelola Data Kriteria** | Admin | Admin dapat menentukan kriteria apa saja yang digunakan untuk penilaian (seperti IPK, Penghasilan Orang Tua), mengatur bobot masing-masing, dan mengkategorikannya menjadi 'benefit' atau 'cost'. |
| **Mengelola Penilaian Mahasiswa** | Admin | Admin mengisi matriks nilai masing-masing calon penerima beasiswa terhadap setiap kriteria yang ada melalui sebuah tabel masukan. |
| **Melihat Hasil Perhitungan DSS** | Admin | Admin mengakses halaman perhitungan untuk melihat transparansi DSS seleksi beasiswa, mulai dari matriks keputusan awal, hasil normalisasi nilai, hingga hasil ranking akhir lengkap dengan perolehan skor preferensi. |
| **Proses Seleksi Penerima Beasiswa** | Admin | Sistem secara otomatis menyeleksi mahasiswa berdasarkan nilai preferensi tertinggi untuk direkomendasikan menerima beasiswa. |

## 4. Diagram Use Case (Mermaid)

```mermaid
flowchart LR
    Admin([Admin / Tim Seleksi])

    subgraph Sistem["DSS Rekomendasi Penerima Beasiswa Akademik"]
        direction TB
        UC1(Mengakses Dashboard)
        UC2(Mengelola Data Mahasiswa)
        UC2A(Import Data Mahasiswa)
        UC3(Mengelola Data Kriteria)
        UC4(Mengelola Penilaian Mahasiswa)
        UC5(Melihat Hasil Perhitungan DSS)
        UC6(Proses Seleksi Penerima Beasiswa)
    end

    Admin --> UC1
    Admin --> UC2
    Admin --> UC3
    Admin --> UC4
    Admin --> UC5
    Admin --> UC6

    UC2A -. "<<extend>>" .-> UC2
    UC6 -. "<<include>>" .-> UC5
```
