# API / Route Documentation

Berdasarkan analisis file routing `routes/web.php` dan `routes/api.php` (tidak ada / tidak digunakan berdasarkan scope project yang mengandalkan controller monolith/web), aplikasi ini adalah **sistem web monolith berbasis Blade/View**. Sistem beroperasi sepenuhnya menggunakan jalur HTTP Request standar (Web Routes) tanpa mengekspos endpoint API JSON publik (RESTful API).

Berikut adalah dokumentasi rute (URL Endpoint) yang diakses oleh peramban pengguna untuk menavigasi aplikasi:

| Endpoint | Method | Fungsi/Deskripsi | Controller |
| -------- | ------ | ---------------- | ---------- |
| `/` | `GET` | Menampilkan halaman Dashboard dan ringkasan Top Kandidat Penerima Beasiswa. | `DssController@dashboard` |
| `/students` | `GET` | Menampilkan daftar seluruh mahasiswa. | `StudentController@index` |
| `/students/create` | `GET` | Menampilkan form input untuk menambah mahasiswa baru. | `StudentController@create` |
| `/students` | `POST` | Menyimpan data mahasiswa baru ke database. | `StudentController@store` |
| `/students/{student}/edit` | `GET` | Menampilkan form untuk mengedit mahasiswa tertentu. | `StudentController@edit` |
| `/students/{student}` | `PUT/PATCH` | Menyimpan perubahan data mahasiswa. | `StudentController@update` |
| `/students/{student}` | `DELETE` | Menghapus data mahasiswa secara spesifik. | `StudentController@destroy` |
| `/students/import` | `POST` | Mengunggah file Excel untuk di-import menjadi data mahasiswa. | `StudentController@import` |
| `/criteria` | `GET` | Menampilkan daftar kriteria penilaian. | `CriterionController@index` |
| `/criteria/create` | `GET` | Menampilkan form input untuk kriteria baru. | `CriterionController@create` |
| `/criteria` | `POST` | Menyimpan kriteria baru beserta bobot dan jenisnya. | `CriterionController@store` |
| `/criteria/{criterion}/edit`| `GET` | Menampilkan form edit kriteria. | `CriterionController@edit` |
| `/criteria/{criterion}` | `PUT/PATCH` | Menyimpan perubahan kriteria. | `CriterionController@update` |
| `/criteria/{criterion}` | `DELETE` | Menghapus data kriteria. | `CriterionController@destroy` |
| `/assessments` | `GET` | Menampilkan halaman form masif (matriks grid) untuk memasukkan nilai seluruh mahasiswa. | `AssessmentController@index` |
| `/assessments` | `POST` | Menyimpan *array* matriks penilaian ke dalam database. | `AssessmentController@store` |
| `/calculation` | `GET` | Memproses algoritma DSS secara *real-time* dan menampilkan halaman Laporan/Hasil Ranking. | `DssController@calculation` |

**Catatan:**
Oleh karena sistem tidak mengekspos rute pada segmen `api/`, maka tidak ada mekanisme Authentication berbasis Token (seperti Sanctum/Passport) dan format balasan *Response* selalu berupa halaman HTML murni (Blade Views) dengan instruksi _redirect_.
