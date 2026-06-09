# Sequence Diagram

Dokumen ini memuat diagram sekuens (Sequence Diagram) yang memodelkan interaksi objek dari proses-proses utama yang ada di sistem berdasarkan implementasi framework Laravel.

*Catatan: Fitur Login belum terimplementasi secara spesifik pada modul yang diberikan, sehingga fokus difokuskan pada fitur inti yang sudah aktif (CRUD Data, Proses Penilaian, dan Perhitungan DSS).*

## 1. Sequence Diagram: CRUD Data Mahasiswa (Contoh: Tambah Data)

```mermaid
sequenceDiagram
    actor Admin
    participant View as View (students.create)
    participant Route as Route (web.php)
    participant Controller as StudentController
    participant Model as Student
    participant Database as Database

    Admin->>View: Isi form data Mahasiswa & Klik "Simpan"
    View->>Route: POST /students
    Route->>Controller: store(Request)
    Controller->>Controller: validate(Request)

    alt Jika Validasi Gagal
        Controller-->>View: Return error messages
    else Jika Validasi Berhasil
        Controller->>Model: create($request->all())
        Model->>Database: INSERT INTO students
        Database-->>Model: Return new ID
        Model-->>Controller: Return instance
        Controller-->>View: Redirect to /students dengan Success Message
    end
```

## 2. Sequence Diagram: Proses Penilaian Matriks Massal

```mermaid
sequenceDiagram
    actor Admin
    participant View as View (assessments.index)
    participant Route as Route (web.php)
    participant Controller as AssessmentController
    participant Model as Assessment
    participant Database as Database

    Admin->>View: Isi/Ubah nilai pada tabel & Klik "Simpan"
    View->>Route: POST /assessments
    Route->>Controller: store(Request)

    loop Untuk Setiap $studentId
        loop Untuk Setiap $criterionId
            Controller->>Model: updateOrCreate(['student_id', 'criterion_id'], ['value'])
            Model->>Database: UPDATE / INSERT
            Database-->>Model: Konfirmasi
            Model-->>Controller: Return instance
        end
    end

    Controller-->>View: Redirect back dengan Success Message
```

## 3. Sequence Diagram: Proses Perhitungan DSS & Generate Ranking

```mermaid
sequenceDiagram
    actor Admin
    participant View as View (calculation.index)
    participant Route as Route (web.php)
    participant Controller as DssController
    participant StuModel as Student
    participant CriModel as Criterion
    participant AssModel as Assessment

    Admin->>View: Klik menu "Hasil Perhitungan"
    View->>Route: GET /calculation
    Route->>Controller: calculation()

    Controller->>Controller: Panggil calculateSAW()
    Controller->>StuModel: get() (with assessments)
    StuModel-->>Controller: Collection of Students
    Controller->>CriModel: all()
    CriModel-->>Controller: Collection of Criteria

    Controller->>AssModel: pluck('value') untuk cari min/max tiap kriteria
    AssModel-->>Controller: Values Array

    Controller->>Controller: Hitung Normalisasi (berdasarkan cost/benefit)
    Controller->>Controller: Hitung Skor Preferensi Akhir ($studentScore)
    Controller->>Controller: Urutkan (usort) berdasarkan $studentScore tertinggi

    Controller-->>View: Return view('calculation.index', $sawData)
    View-->>Admin: Menampilkan tabel hasil dan daftar ranking
```
