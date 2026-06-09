# Activity Diagram

Diagram aktivitas di bawah ini menjelaskan aliran kerja (workflow) spesifik antara aktor (Admin) dengan Sistem selama proses pengelolaan penilaian hingga tahap munculnya rekomendasi keputusan.

```mermaid
stateDiagram-v2
    [*] --> Admin_Buka_Menu_Penilaian

    state Admin_Buka_Menu_Penilaian {
        [*] --> Pilih_Menu
        Pilih_Menu --> Sistem_Tampil_Matriks
    }

    Admin_Buka_Menu_Penilaian --> Admin_Input_Nilai

    state Admin_Input_Nilai {
        [*] --> Isi_Nilai_Tiap_Kolom
        Isi_Nilai_Tiap_Kolom --> Tekan_Tombol_Simpan
    }

    Admin_Input_Nilai --> Sistem_Simpan_Database

    state Sistem_Simpan_Database {
        [*] --> Validasi_Data
        Validasi_Data --> UpdateOrCreate_Data
        UpdateOrCreate_Data --> Beri_Pesan_Sukses
    }

    Sistem_Simpan_Database --> Admin_Buka_Menu_Kalkulasi

    state Admin_Buka_Menu_Kalkulasi {
        [*] --> Klik_Hasil_Kalkulasi
    }

    Admin_Buka_Menu_Kalkulasi --> Sistem_Hitung_SAW

    state Sistem_Hitung_SAW {
        [*] --> Ambil_Data_Penilaian
        Ambil_Data_Penilaian --> Cari_Min_Max
        Cari_Min_Max --> Lakukan_Normalisasi
        Lakukan_Normalisasi --> Hitung_Total_Preferensi
        Hitung_Total_Preferensi --> Urutkan_Ranking
        Urutkan_Ranking --> Tampilkan_Halaman_Hasil
    }

    Sistem_Hitung_SAW --> [*]
```

## Penjelasan Langkah
1. **Buka Menu Penilaian:** Admin masuk ke halaman Assessments, kemudian Sistem menampilkan grid tabel/matriks yang mempertemukan mahasiswa dengan kriteria.
2. **Input Nilai:** Admin memasukkan atau merevisi nilai yang ada pada grid, dan menekan tombol simpan.
3. **Simpan ke Database:** Sistem menangkap seluruh kumpulan (array) data masukan, kemudian menyimpannya ke tabel `assessments` melalui logika *update or create*.
4. **Buka Menu Kalkulasi:** Setelah data nilai disimpan, Admin berpindah ke menu Kalkulasi (Calculation).
5. **Hitung SAW:** Saat menu diakses, Sistem mengeksekusi algoritma *Simple Additive Weighting* pada saat itu juga (on-the-fly) lalu menampilkan hasilnya secara urut ke layar.
