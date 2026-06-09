<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Criterion;
use App\Models\Student;
use App\Models\Assessment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Kriteria
        $c1 = Criterion::create(['code' => 'C1', 'name' => 'IPK', 'type' => 'benefit', 'weight' => 0.35]);
        $c2 = Criterion::create(['code' => 'C2', 'name' => 'Penghasilan Orang Tua', 'type' => 'cost', 'weight' => 0.25]);
        $c3 = Criterion::create(['code' => 'C3', 'name' => 'Tanggungan Anak', 'type' => 'benefit', 'weight' => 0.20]);
        $c4 = Criterion::create(['code' => 'C4', 'name' => 'Prestasi Non-Akademik', 'type' => 'benefit', 'weight' => 0.20]);

        // 2. Mahasiswa
        $s1 = Student::create(['nim' => '20230001', 'name' => 'Ahmad Budi', 'major' => 'Informatika']);
        $s2 = Student::create(['nim' => '20230002', 'name' => 'Siti Nurhaliza', 'major' => 'Sistem Informasi']);
        $s3 = Student::create(['nim' => '20230003', 'name' => 'Bambang Pamungkas', 'major' => 'Informatika']);

        // 3. Nilai
        // Ahmad
        Assessment::create(['student_id' => $s1->id, 'criterion_id' => $c1->id, 'value' => 3.8]);
        Assessment::create(['student_id' => $s1->id, 'criterion_id' => $c2->id, 'value' => 3000000]); // 3 juta
        Assessment::create(['student_id' => $s1->id, 'criterion_id' => $c3->id, 'value' => 3]);
        Assessment::create(['student_id' => $s1->id, 'criterion_id' => $c4->id, 'value' => 85]);

        // Siti
        Assessment::create(['student_id' => $s2->id, 'criterion_id' => $c1->id, 'value' => 3.9]);
        Assessment::create(['student_id' => $s2->id, 'criterion_id' => $c2->id, 'value' => 1500000]); // 1.5 juta
        Assessment::create(['student_id' => $s2->id, 'criterion_id' => $c3->id, 'value' => 2]);
        Assessment::create(['student_id' => $s2->id, 'criterion_id' => $c4->id, 'value' => 90]);

        // Bambang
        Assessment::create(['student_id' => $s3->id, 'criterion_id' => $c1->id, 'value' => 3.5]);
        Assessment::create(['student_id' => $s3->id, 'criterion_id' => $c2->id, 'value' => 5000000]); // 5 juta
        Assessment::create(['student_id' => $s3->id, 'criterion_id' => $c3->id, 'value' => 1]);
        Assessment::create(['student_id' => $s3->id, 'criterion_id' => $c4->id, 'value' => 70]);
    }
}
