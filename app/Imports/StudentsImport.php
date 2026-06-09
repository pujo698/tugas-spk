<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Pastikan kolom 'nim' dan 'name' ada sebelum di-insert
        if (!isset($row['nim']) || !isset($row['name'])) {
            return null;
        }

        // Cek jika NIM sudah ada agar tidak duplikat
        $existingStudent = Student::where('nim', $row['nim'])->first();
        if ($existingStudent) {
            // Update data yang sudah ada jika mau, atau skip
            // $existingStudent->update([
            //     'name' => $row['name'],
            //     'major' => $row['major'] ?? null,
            // ]);
            return null;
        }

        return new Student([
            'nim'     => $row['nim'],
            'name'    => $row['name'],
            'major'   => $row['major'] ?? null,
        ]);
    }
}
