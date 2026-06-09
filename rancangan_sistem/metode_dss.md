# Metode Decision Support System (DSS)

Berdasarkan analisis file sumber `app/Http/Controllers/DssController.php`, sistem pendukung keputusan ini menerapkan metode **Simple Additive Weighting (SAW)**.

Metode SAW sering juga dikenal sebagai metode penjumlahan terbobot. Konsep dasar metode SAW adalah mencari penjumlahan terbobot dari rating kinerja pada setiap alternatif (mahasiswa) pada semua atribut (kriteria).

## Konsep Metode SAW
Metode SAW membutuhkan proses normalisasi matriks keputusan ke suatu skala yang dapat diperbandingkan dengan semua rating alternatif yang ada.

**Langkah-langkah Metode SAW:**
1. Menentukan kriteria dan bobot prioritasnya (W).
2. Menentukan rating kecocokan (matriks keputusan) setiap alternatif pada setiap kriteria.
3. Melakukan normalisasi matriks (R) berdasarkan persamaan normalisasi, yang tergantung pada tipe kriteria (*benefit* atau *cost*).
4. Menghitung nilai preferensi (V) atau hasil akhir dari setiap alternatif dengan menjumlahkan hasil kali normalisasi matriks dengan bobot kriteria.
5. Melakukan perangkingan.

## Rumus Normalisasi

### Kriteria Benefit (Keuntungan)
Jika kriteria bertipe **benefit** (semakin besar nilai semakin bagus, misalnya IPK):
`R_ij = X_ij / Max(X_ij)`

### Kriteria Cost (Biaya)
Jika kriteria bertipe **cost** (semakin kecil nilai semakin bagus, misalnya Penghasilan Orang Tua untuk mendapatkan beasiswa/bantuan):
`R_ij = Min(X_ij) / X_ij`

## Rumus Nilai Preferensi (Hasil Akhir)
`V_i = Σ (W_j * R_ij)`
* Keterangan: `V_i` adalah skor untuk alternatif mahasiswa ke-`i`, `W_j` adalah bobot kriteria ke-`j`, dan `R_ij` adalah nilai normalisasi.

## Implementasi Source Code
File yang mengelola perhitungan algoritma ini adalah `app/Http/Controllers/DssController.php` pada *method* `calculateSAW()`.

Berikut adalah ringkasan potongan kode implementasinya:

### 1. Mencari Min/Max (Bentuk Matriks Keputusan)
Sistem pertama-tama mengelompokkan nilai setiap kriteria dan mencari nilai minimum serta maksimum menggunakan fungsi agregasi PHP.
```php
$minMax = [];
foreach ($criteria as $criterion) {
    $values = Assessment::where('criterion_id', $criterion->id)->pluck('value')->toArray();
    if(count($values) > 0) {
        $minMax[$criterion->id] = [
            'min' => min($values),
            'max' => max($values)
        ];
    }
}
```

### 2. Normalisasi
Sistem mengulang seluruh data mahasiswa dan menormalisasinya berdasarkan nilai tipe kriteria.
```php
$normalizedValue = 0;
if(isset($minMax[$criterion->id]) && $minMax[$criterion->id]['max'] > 0) {
    if ($criterion->type == 'benefit') {
        $normalizedValue = $value / $minMax[$criterion->id]['max'];
    } else {
        // Cost
        $normalizedValue = $value > 0 ? $minMax[$criterion->id]['min'] / $value : 0;
    }
}
$normalizedMatrix[$student->id][$criterion->id] = $normalizedValue;
```

### 3. Pembobotan & Penghitungan Hasil Akhir
Setelah nilai didapatkan, nilai normalisasi dikalikan dengan bobot kriteria terkait dan dijumlahkan ke skor mahasiswa secara kumulatif.
```php
$studentScore += ($normalizedValue * $criterion->weight);
// ...
$finalScores[$student->id] = [
    'student' => $student,
    'score' => $studentScore
];
```

### 4. Perangkingan
Skor akhir dikelompokkan ke array lalu diurutkan dari skor terbesar (Descending).
```php
usort($finalScores, function ($item1, $item2) {
    return $item2['score'] <=> $item1['score'];
});
```
