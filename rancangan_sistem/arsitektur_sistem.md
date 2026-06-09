# Arsitektur Sistem

Aplikasi ini menggunakan arsitektur web modern yang mengikuti pola **MVC (Model-View-Controller)** melalui framework Laravel.

Berikut adalah diagram arsitektur sistem:

```mermaid
flowchart TD
    User([User / Admin])

    subgraph Frontend [Presentation Layer / Frontend]
        Blade[Blade Template Engine]
        Tailwind[Tailwind CSS]
    end

    subgraph Backend [Application Layer / Backend - Laravel]
        Route[Router web.php]

        subgraph Controllers
            StuCtrl[StudentController]
            CriCtrl[CriterionController]
            AssCtrl[AssessmentController]
            DSSCtrl[DssController]
        end

        subgraph Models
            StuMod[Student Model]
            CriMod[Criterion Model]
            AssMod[Assessment Model]
        end

        Excel[Maatwebsite Excel\nLibrary]
    end

    subgraph Data [Data Layer]
        DB[(Database SQLite / MySQL)]
    end

    %% Alur Kerja User -> Sistem
    User <-->|HTTP Request/Response| Frontend
    Frontend <-->|Rendering & Form Submit| Route

    %% Alur Routing ke Controller
    Route --> StuCtrl
    Route --> CriCtrl
    Route --> AssCtrl
    Route --> DSSCtrl

    %% Alur Excel
    StuCtrl <--> Excel

    %% Alur Controller ke Model
    StuCtrl <--> StuMod
    CriCtrl <--> CriMod
    AssCtrl <--> AssMod
    DSSCtrl <--> StuMod
    DSSCtrl <--> CriMod
    DSSCtrl <--> AssMod

    %% Alur Model ke Database
    StuMod <--> DB
    CriMod <--> DB
    AssMod <--> DB
```

## Penjelasan Arsitektur

1. **User / Admin:** Berinteraksi dengan aplikasi melalui web browser.
2. **Frontend Layer:** Menangani antarmuka menggunakan Blade Template Engine (bawaan Laravel) yang disokong oleh styling menggunakan Tailwind CSS dan Vite untuk kompilasi aset.
3. **Backend Layer (Laravel):**
   * **Route:** `web.php` menerima permintaan HTTP dari pengguna dan mengarahkannya ke metode pengontrol yang tepat.
   * **Controllers:** Memproses logika bisnis. Contohnya, `DssController` melakukan proses kalkulasi Simple Additive Weighting (SAW) berdasarkan data.
   * **Models:** Mendefinisikan struktur entitas database, melakukan manipulasi data (Eloquent ORM), dan mengatur relasi (`Student`, `Criterion`, `Assessment`).
   * **Library Eksternal:** `Maatwebsite Excel` digunakan oleh `StudentController` untuk mengekstrak data dari file excel lalu menyimpannya melalui model.
4. **Data Layer:** Merupakan DBMS (seperti SQLite/MySQL) yang menyimpan tabel data mentah secara permanen. Model Laravel (Eloquent) berhubungan secara aktif terhadap layer ini.
