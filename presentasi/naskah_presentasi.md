# Naskah Presentasi UAS Sistem Pendukung Keputusan

Naskah ini disusun untuk mendukung `materi_presentasi.md` dan ditargetkan untuk durasi presentasi sekitar 10–15 menit.

---

**Slide 1: Judul**
"Selamat pagi Bapak/Ibu Dosen dan rekan-rekan sekalian. Pada kesempatan kali ini, kelompok kami akan mempresentasikan proyek Ujian Akhir Semester untuk mata kuliah Sistem Pendukung Keputusan. Proyek yang kami kembangkan adalah 'DSS Rekomendasi Penerima Beasiswa Akademik'. Anggota kelompok kami terdiri dari [Nama 1], [Nama 2], dan [Nama 3]."

**Slide 2: Latar Belakang**
"Proyek ini dilatarbelakangi oleh permasalahan umum dalam proses seleksi beasiswa akademik di kampus. Setiap semesternya, jumlah pendaftar beasiswa seringkali jauh melebihi kuota yang tersedia. Selama ini, proses seleksi secara manual memakan waktu yang cukup lama. Selain itu, pihak penyeleksi seringkali menemui kendala dalam membandingkan nilai mahasiswa secara adil, karena kriteria yang digunakan memiliki satuan dan skala yang berbeda-beda, sehingga rentan terhadap unsur subjektivitas."

**Slide 3: Tujuan Sistem**
"Oleh karena itu, tujuan utama dari pengembangan aplikasi DSS ini adalah untuk membantu pihak kampus melakukan proses seleksi penerima beasiswa secara lebih objektif, transparan, dan konsisten. Kami ingin memastikan bahwa keputusan yang diambil pada akhirnya sepenuhnya didasarkan pada data kuantitatif yang dapat dipertanggungjawabkan."

**Slide 4: Gambaran Umum Sistem**
"Secara umum, aplikasi yang kami bangun ini merupakan aplikasi berbasis web menggunakan *framework* Laravel. Fungsi utamanya adalah mengelola data mahasiswa sebagai alternatif pilihan, mengelola kriteria penilaian, dan secara otomatis melakukan kalkulasi untuk menghasilkan peringkat. Secara teknis, kami menggunakan arsitektur *Model-View-Controller* atau MVC untuk memisahkan antara logika perhitungan di belakang layar, manajemen data di dalam *database*, serta antarmuka yang akan digunakan oleh *user*."

**Slide 5: Metode DSS yang Digunakan**
"Metode yang kami terapkan dalam sistem ini adalah *Simple Additive Weighting* (SAW), atau yang sering dikenal sebagai metode penjumlahan terbobot. Kami memilih metode SAW karena kemampuannya yang sangat baik dalam melakukan penilaian yang presisi. Metode ini mampu menyeimbangkan berbagai kriteria yang memiliki dimensi berbeda, contohnya nilai akademik seperti IPK dengan kondisi ekonomi seperti Penghasilan Orang Tua, melalui suatu proses yang dinamakan normalisasi matriks."

**Slide 6: Kriteria Penilaian**
"Berdasarkan implementasi pada sistem, kami menggunakan empat kriteria utama:
Pertama, C1 yaitu IPK, dengan bobot 35% dan bersifat *Benefit*. Artinya, semakin tinggi IPK, semakin besar poinnya.
Kedua, C2 yaitu Penghasilan Orang Tua, bobot 25% dan bersifat *Cost*. Karena ini beasiswa, maka semakin rendah penghasilannya, nilainya justru semakin besar.
Ketiga, C3 yaitu Tanggungan Anak, bobot 20%, bersifat *Benefit*.
Keempat, C4 yaitu Prestasi Non-Akademik, bobot 20%, bersifat *Benefit*.
Sistem kami juga dirancang secara dinamis, sehingga pihak admin dapat menambah atau mengubah kriteria kapan saja melalui aplikasi."

**Slide 7: Alur Sistem**
"Adapun alur kerja sistem ini dimulai dengan menginputkan data mahasiswa dan kriteria beserta bobotnya. Selanjutnya, kita melakukan penilaian untuk setiap mahasiswa. Setelah data terkumpul, sistem (DSS) akan mulai bekerja dengan mengekstrak nilai minimal dan maksimal dari setiap kriteria. Berdasarkan nilai tersebut, sistem melakukan normalisasi matriks ke dalam rasio angka 0 hingga 1. Angka rasio ini kemudian dikalikan dengan bobot kriteria untuk mendapatkan nilai preferensi, yang pada akhirnya akan diurutkan dari skor tertinggi hingga terendah."

**Slide 8: Implementasi Aplikasi**
"Di dalam aplikasi, kami telah mengimplementasikan beberapa fitur utama. Terdapat *Dashboard* yang menampilkan ringkasan statistik dan tiga kandidat terbaik. Terdapat pula modul Manajemen Kriteria dan Manajemen Mahasiswa. Lalu ada fitur Penilaian atau *Assessment* tempat admin memasukkan skor mentah. Dan yang paling penting adalah halaman Kalkulasi dan Laporan, di mana proses matriks dan normalisasi ditampilkan secara transparan."

**Slide 9: Contoh Perhitungan DSS**
"Untuk memberikan gambaran perhitungan, mari kita lihat satu contoh. Misalkan Mahasiswa A memiliki IPK 3.8, yang merupakan kriteria *Benefit*. Maka, proses normalisasinya adalah membagi 3.8 dengan nilai IPK tertinggi dari seluruh pendaftar, katakanlah 3.9. Sebaliknya, untuk kriteria *Cost* seperti penghasilan, misalnya penghasilan Mahasiswa A adalah 3 juta rupiah. Maka, nilai minimal penghasilan seluruh pendaftar, misal 1.5 juta, akan dibagi dengan 3 juta. Hasil normalisasi inilah yang nantinya akan dikalikan dengan bobot kriteria masing-masing dan dijumlahkan menjadi nilai akhir."

**Slide 10: Hasil Ranking**
"Dari proses perhitungan tersebut, sistem akan menghasilkan rekomendasi berupa tabel *ranking*. Tabel ini diurutkan dari skor preferensi tertinggi. Sebagai contoh, jika mahasiswa bernama Siti Nurhaliza mendapatkan skor akhir 0.94, maka secara matematis ia adalah kandidat yang paling optimal. Sistem akan menempatkannya di peringkat pertama dan sangat merekomendasikan mahasiswa tersebut sebagai penerima beasiswa akademik."

**Slide 11: Kelebihan Sistem**
"Sistem yang kami kembangkan memiliki beberapa kelebihan. Pertama, mengeliminasi *human error* dalam perhitungan seleksi yang rumit. Kedua, sangat transparan; sistem memperlihatkan seluruh langkah kalkulasi, bukan sekadar memberikan hasil akhir secara tiba-tiba. Ketiga, sistem ini fleksibel, pihak kampus dengan mudah dapat menyesuaikan bobot jika ada perubahan kebijakan tanpa perlu mengubah kode program."

**Slide 12: Kesimpulan**
"Sebagai kesimpulan, implementasi metode SAW pada aplikasi berbasis web ini terbukti berhasil mentransformasi proses seleksi menjadi sistem yang berbasis data atau *data-driven*. Aplikasi ini tidak menggantikan peran pengambil keputusan, melainkan bertindak sebagai pendukung komputasi yang memberikan rekomendasi dan dasar kuantitatif yang kuat bagi pihak kampus untuk menentukan siapa yang berhak menerima beasiswa akademik."

**Slide 13: Terima Kasih**
"Sekian presentasi dari kelompok kami terkait DSS Rekomendasi Penerima Beasiswa Akademik. Terima kasih atas perhatian Bapak/Ibu Dosen dan rekan-rekan. Selanjutnya, kami persilakan jika ada pertanyaan atau masukan."
