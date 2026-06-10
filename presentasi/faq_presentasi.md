# FAQ (Frequently Asked Questions) Presentasi UAS

Berikut adalah daftar prediksi pertanyaan yang sering diajukan saat presentasi proyek DSS beserta jawaban singkatnya. Jawaban ini disusun berdasarkan dokumentasi dan implementasi aplikasi.

---

**1. Mengapa memilih studi kasus seleksi beasiswa akademik?**
*Jawaban:* Karena proses seleksi beasiswa seringkali melibatkan banyak kriteria dengan skala berbeda (misal, IPK skala 4.0 vs penghasilan jutaan Rupiah), sehingga sangat relevan dan ideal untuk dipecahkan menggunakan Sistem Pendukung Keputusan.

**2. Metode apa yang digunakan dalam sistem ini?**
*Jawaban:* Kami menggunakan metode *Simple Additive Weighting* (SAW), atau yang lebih dikenal dengan metode penjumlahan terbobot.

**3. Mengapa memilih metode SAW dibanding metode lain (seperti AHP atau TOPSIS)?**
*Jawaban:* Metode SAW dipilih karena lebih efisien, komputasinya lebih ringan, namun tetap akurat. SAW sangat baik dalam memproses matriks keputusan di mana setiap atribut perlu dinormalisasi dan diberikan bobot preferensi yang independen.

**4. Apa saja kriteria yang digunakan dalam aplikasi ini?**
*Jawaban:* Berdasarkan data *default* sistem, kami menggunakan IPK, Penghasilan Orang Tua, Jumlah Tanggungan Anak, dan Prestasi Non-Akademik.

**5. Apakah kriteria tersebut mutlak atau bisa diubah?**
*Jawaban:* Kriteria tidak mutlak. Sistem kami bersifat dinamis, sehingga pihak admin/kampus dapat menambah, menghapus, atau mengubah kriteria serta bobotnya secara langsung melalui antarmuka sistem tanpa mengubah *source code*.

**6. Apa perbedaan antara kriteria Benefit dan Cost?**
*Jawaban:* Kriteria *Benefit* berarti semakin tinggi nilainya semakin baik (contoh: IPK). Sebaliknya, kriteria *Cost* berarti semakin kecil nilainya semakin baik (contoh: Penghasilan Orang tua; semakin kecil penghasilannya, semakin berhak mendapat beasiswa).

**7. Bagaimana rumus normalisasi untuk kriteria Benefit di sistem ini?**
*Jawaban:* Rumusnya adalah: Nilai mahasiswa pada kriteria tersebut dibagi dengan Nilai Maksimal dari semua mahasiswa pada kriteria tersebut `(X_ij / Max(X_ij))`.

**8. Bagaimana rumus normalisasi untuk kriteria Cost?**
*Jawaban:* Rumusnya dibalik, yaitu: Nilai Minimal dari semua mahasiswa pada kriteria tersebut dibagi dengan Nilai mahasiswa tersebut `(Min(X_ij) / X_ij)`.

**9. Bagaimana sistem menghasilkan hasil akhir/ranking?**
*Jawaban:* Hasil akhir didapat dengan mengalikan matriks normalisasi setiap mahasiswa dengan bobot prioritas setiap kriteria. Hasil penjumlahan seluruh kriteria tersebut menghasilkan "Nilai Preferensi", yang kemudian diurutkan dari skor tertinggi (peringkat 1) ke terendah.

**10. Framework apa yang digunakan untuk membangun sistem ini?**
*Jawaban:* Kami menggunakan *framework* PHP Laravel dengan arsitektur *Model-View-Controller* (MVC), dikombinasikan dengan Tailwind CSS untuk tampilan antarmuka.

**11. Di mana letak logika perhitungan algoritma SAW pada source code?**
*Jawaban:* Logika perhitungan berada pada lapisan Controller, secara spesifik di dalam file `app/Http/Controllers/DssController.php`.

**12. Apakah aplikasi ini otomatis memutuskan penerima beasiswa?**
*Jawaban:* Tidak. Aplikasi ini adalah Sistem Pendukung Keputusan (DSS), fungsinya memberikan *rekomendasi* peringkat berdasarkan perhitungan matematis. Keputusan final tetap berada di tangan pihak manajemen kampus.

**13. Apa yang terjadi jika ada dua mahasiswa dengan nilai akhir yang sama persis?**
*Jawaban:* Sistem akan menempatkan mereka secara berurutan. Dalam kondisi dunia nyata, admin biasanya akan meninjau kriteria prioritas tertinggi (misalnya siapa yang memiliki tanggungan lebih banyak) atau menambahkan kriteria penentu baru (karena sistem ini dinamis).

**14. Bagaimana sistem menyimpan data penilaian yang berbeda skalanya?**
*Jawaban:* Sistem menyimpan data "mentah" di *database* (misalnya angka 3.8 untuk IPK atau angka 3000000 untuk penghasilan). Sistem baru akan mengubah skala angka tersebut menjadi seragam (0.0 - 1.0) pada saat proses kalkulasi/normalisasi dilakukan di memori.

**15. Apa kelebihan implementasi sistem ini dibandingkan proses seleksi manual (Excel)?**
*Jawaban:* Sistem ini jauh lebih *scalable* (mudah menangani ribuan mahasiswa), minim *human error* karena rumus telah ditanamkan dalam kode (tidak berisiko salah ketik rumus seperti di *spreadsheet*), dan memiliki basis data terpusat (*database*) yang aman.

**16. Bagaimana cara sistem menghindari input nilai yang salah?**
*Jawaban:* Melalui fitur validasi data (*form validation*) yang ada di Laravel. Sistem memastikan hanya angka yang dapat dimasukkan untuk kolom penilaian kriteria.