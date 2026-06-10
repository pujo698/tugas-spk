# Kesimpulan Analisis Sistem

Berdasarkan analisis *reverse engineering* terhadap keseluruhan struktur *source code*, logika aplikasi, dan implementasi *database* pada repositori "DSS Rekomendasi Penerima Beasiswa Akademik", berikut adalah kesimpulan komprehensif yang dapat ditarik:

## Ringkasan Hasil Analisis
Sistem ini merupakan aplikasi web monolitik yang solid, dikembangkan di atas pondasi framework **Laravel 10/11**. Sistem ini telah terintegrasi dengan metode pengambilan keputusan kuantitatif yaitu **Simple Additive Weighting (SAW)** yang sangat relevan untuk kebutuhan seleksi bantuan sosial atau pendidikan. Logika *backend* mampu mengurai relasi data antara entitas *Mahasiswa* dan *Kriteria* (seperti IPK dan Penghasilan Orang Tua) ke dalam matriks keputusan, menormalisasinya, menerapkan bobot prioritas, dan akhirnya menghasilkan rekomendasi *ranking* penerima beasiswa.

## Kelebihan Sistem
1. **Penerapan Algoritma yang Fleksibel & Dinamis:** Algoritma SAW pada `DssController` tidak dilakukan secara "hardcoded". Artinya, berapapun jumlah kriteria yang diinput, algoritma akan otomatis menyesuaikan bentuk matriks secara dinamis.
2. **User Experience (UX) yang Efisien:** Khususnya pada menu Penilaian (`/assessments`), desain grid/matriks yang memungkinkan *mass-input* sangat menghemat waktu admin dibandingkan harus mengisi nilai satu persatu setiap calon penerima beasiswa.
3. **Fitur Import Excel:** Penggunaan pustaka `Maatwebsite Excel` mempercepat fase pendataan awal *Student*, yang mana ini merupakan titik kritis pada sistem yang membutuhkan pengisian data banyak.
4. **Desain Database yang Bersih:** Penggunaan tabel `assessments` sebagai pivot membuat pemisahan entitas menjadi sangat rapi dan menekan terjadinya redundansi data (Normalisasi Database).

## Kekurangan Sistem
1. **Tidak Adanya Sistem Autentikasi (Login/Roles):** Berdasarkan analisis alur (Routing), rute aplikasi dapat diakses tanpa penjagaan *middleware auth*. Sistem tidak bisa membatasi siapa yang berhak menambah atau mengubah nilai secara default.
2. **Beban Komputasi _On-the-Fly_:** Algoritma dihitung pada saat itu juga (real-time) setiap halaman Dashboard dan Calculation diakses. Jika data mencapai ribuan mahasiswa dan puluhan kriteria, proses _looping_ _O(M*N)_ secara real-time dapat menyebabkan degradasi performa/waktu muat halaman.

## Potensi Pengembangan (Saran)
1. **Implementasi Autentikasi dan Otorisasi:** Menerapkan fitur perlindungan jalur menggunakan bawaan Laravel (`Breeze` atau `Jetstream`) sehingga ada pemisahan jelas antara _Super Admin_ (pengatur kriteria) dengan _Tim Seleksi_ (penginput nilai beasiswa).
2. **Fitur Simpan / Cetak Laporan Historis:** Sistem saat ini hanya menampilkan perhitungan berdasar data ter-*update*. Disarankan menambah fitur untuk menyimpan "Sesi Kalkulasi" (misal: Seleksi Beasiswa Tahun 2023) menjadi laporan statis (PDF).
3. **Peningkatan Formulasi Nilai (Sub-Kriteria):** Menambahkan *range* sub-kriteria (misal: "Penghasilan 1-2 Juta = Nilai 5"). Saat ini sistem menggunakan masukan nilai mentah / abstrak, yang bisa cukup sulit bagi admin jika tidak ada standarisasi form sub-kriteria secara spesifik untuk seleksi beasiswa.
