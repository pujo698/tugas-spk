# Simulasi Perhitungan DSS

Berikut adalah dokumentasi simulasi manual dari algoritma SAW, persis seperti yang dihitung oleh sistem secara *backend*, menggunakan sampel data (seed data) dari `DatabaseSeeder.php` untuk seleksi penerima beasiswa akademik.

## 1. Kriteria dan Bobot
* **C1 (Benefit):** IPK, Bobot = 0.35
* **C2 (Cost):** Penghasilan Orang Tua, Bobot = 0.25
* **C3 (Benefit):** Tanggungan Anak, Bobot = 0.20
* **C4 (Benefit):** Prestasi Non-Akademik, Bobot = 0.20

## 2. Alternatif (Calon Penerima Beasiswa)
* **A1:** Ahmad Budi
* **A2:** Siti Nurhaliza
* **A3:** Bambang Pamungkas

## 3. Matriks Keputusan Awal (Nilai Asli)
*Data Mentah*
* **A1:** C1=3.8 | C2=3,000,000 | C3=3 | C4=85
* **A2:** C1=3.9 | C2=1,500,000 | C3=2 | C4=90
* **A3:** C1=3.5 | C2=5,000,000 | C3=1 | C4=70

| Alternatif | C1 | C2 | C3 | C4 |
| :---: | :---: | :---: | :---: | :---: |
| **A1** | 3.8 | 3000000 | 3 | 85 |
| **A2** | 3.9 | 1500000 | 2 | 90 |
| **A3** | 3.5 | 5000000 | 1 | 70 |

*Nilai Min/Max:*
* **C1 (Benefit, cari Max):** Max = 3.9
* **C2 (Cost, cari Min):** Min = 1,500,000
* **C3 (Benefit, cari Max):** Max = 3
* **C4 (Benefit, cari Max):** Max = 90

## 4. Normalisasi Matriks Keputusan
**C1 (Benefit) -> R = Nilai / Max**
* R(A1, C1) = 3.8 / 3.9 = 0.974
* R(A2, C1) = 3.9 / 3.9 = 1.000
* R(A3, C1) = 3.5 / 3.9 = 0.897

**C2 (Cost) -> R = Min / Nilai**
* R(A1, C2) = 1,500,000 / 3,000,000 = 0.500
* R(A2, C2) = 1,500,000 / 1,500,000 = 1.000
* R(A3, C2) = 1,500,000 / 5,000,000 = 0.300

**C3 (Benefit) -> R = Nilai / Max**
* R(A1, C3) = 3 / 3 = 1.000
* R(A2, C3) = 2 / 3 = 0.667
* R(A3, C3) = 1 / 3 = 0.333

**C4 (Benefit) -> R = Nilai / Max**
* R(A1, C4) = 85 / 90 = 0.944
* R(A2, C4) = 90 / 90 = 1.000
* R(A3, C4) = 70 / 90 = 0.778

**Tabel Hasil Normalisasi:**
| Alternatif | C1 | C2 | C3 | C4 |
| :---: | :---: | :---: | :---: | :---: |
| **A1** | 0.974 | 0.500 | 1.000 | 0.944 |
| **A2** | 1.000 | 1.000 | 0.667 | 1.000 |
| **A3** | 0.897 | 0.300 | 0.333 | 0.778 |

## 5. Menghitung Nilai Preferensi / Akhir (V)
Kalikan hasil normalisasi dengan Bobot (C1=0.35, C2=0.25, C3=0.20, C4=0.20)

* **V(A1)** = (0.974 * 0.35) + (0.500 * 0.25) + (1.000 * 0.20) + (0.944 * 0.20)
  = 0.3409 + 0.1250 + 0.2000 + 0.1888 = **0.8547**
* **V(A2)** = (1.000 * 0.35) + (1.000 * 0.25) + (0.667 * 0.20) + (1.000 * 0.20)
  = 0.3500 + 0.2500 + 0.1334 + 0.2000 = **0.9334**
* **V(A3)** = (0.897 * 0.35) + (0.300 * 0.25) + (0.333 * 0.20) + (0.778 * 0.20)
  = 0.3139 + 0.0750 + 0.0666 + 0.1556 = **0.6111**

## 6. Hasil Ranking
Berdasarkan nilai Preferensi, maka sistem akan memberikan daftar rekomendasi penerima beasiswa sebagai berikut:

| Peringkat | Calon Penerima Beasiswa | Skor Akhir |
| :---: | --------- | :---: |
| **1** | **Siti Nurhaliza (A2)** | **0.9334** |
| 2 | Ahmad Budi (A1) | 0.8547 |
| 3 | Bambang Pamungkas (A3) | 0.6111 |

**Kesimpulan Simulasi:**
Sistem telah menghitung secara presisi, bahwa dengan memperhitungkan kombinasi benefit (IPK, dll) dan cost (Penghasilan Orang Tua) serta seluruh kriteria secara matematis, Siti Nurhaliza direkomendasikan sebagai penerima beasiswa akademik terbaik karena mendominasi nilai pada mayoritas kriteria, utamanya berkat kondisi penghasilan orang tua terkecil (cost terbaik) dan prestasi non-akademik tertinggi (benefit terbaik).
