# Desain Database

Berikut adalah desain tabel di dalam database berdasarkan file migrasi dari source code Laravel (`database/migrations`).

---

# Tabel `students`

## Tujuan
Menyimpan data induk mahasiswa yang menjadi alternatif kandidat penerima beasiswa dalam sistem pendukung keputusan.

## Struktur

| Field | Tipe | Null | Key | Keterangan |
| ----- | ---- | ---- | --- | ---------- |
| `id` | BigInt, Unsigned | No | Primary | ID unik berurutan secara otomatis |
| `nim` | String | No | Unique | Nomor Induk Mahasiswa |
| `name` | String | No | - | Nama lengkap mahasiswa |
| `major` | String | No | - | Jurusan / Program Studi mahasiswa |
| `created_at` | Timestamp | Yes | - | Waktu data dibuat |
| `updated_at` | Timestamp | Yes | - | Waktu data terakhir diperbarui |

## Relasi
- *One-to-Many* dengan tabel `assessments`.

---

# Tabel `criteria`

## Tujuan
Menyimpan data kriteria penilaian, termasuk bobot kepentingan dan sifat/tipe kriteria (Benefit atau Cost) yang menjadi dasar algoritma SAW.

## Struktur

| Field | Tipe | Null | Key | Keterangan |
| ----- | ---- | ---- | --- | ---------- |
| `id` | BigInt, Unsigned | No | Primary | ID unik berurutan secara otomatis |
| `code` | String | No | Unique | Kode kriteria (contoh: C1, C2) |
| `name` | String | No | - | Nama spesifik kriteria |
| `type` | Enum('benefit', 'cost') | No | - | Tipe kriteria untuk penentuan normalisasi |
| `weight` | Float | No | - | Bobot prioritas kriteria dalam desimal |
| `created_at` | Timestamp | Yes | - | Waktu data dibuat |
| `updated_at` | Timestamp | Yes | - | Waktu data terakhir diperbarui |

## Relasi
- *One-to-Many* dengan tabel `assessments`.

---

# Tabel `assessments`

## Tujuan
Menyimpan nilai evaluasi kuantitatif dari setiap mahasiswa terhadap setiap kriteria penilaian. Tabel ini adalah tabel pivot antara entitas mahasiswa dan kriteria.

## Struktur

| Field | Tipe | Null | Key | Keterangan |
| ----- | ---- | ---- | --- | ---------- |
| `id` | BigInt, Unsigned | No | Primary | ID unik berurutan secara otomatis |
| `student_id` | BigInt, Unsigned | No | Foreign | Mereferensi `id` dari tabel `students` |
| `criterion_id` | BigInt, Unsigned | No | Foreign | Mereferensi `id` dari tabel `criteria` |
| `value` | Float | No | - | Nilai mentah dari hasil evaluasi |
| `created_at` | Timestamp | Yes | - | Waktu data dibuat |
| `updated_at` | Timestamp | Yes | - | Waktu data terakhir diperbarui |

## Relasi
- Berelasi (*Foreign Key Constraint*) dengan `students.id` dengan tindakan `ON DELETE CASCADE`.
- Berelasi (*Foreign Key Constraint*) dengan `criteria.id` dengan tindakan `ON DELETE CASCADE`.
