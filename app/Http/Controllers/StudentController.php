<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'ilike', "%{$search}%")
                  ->orWhere('nim', 'ilike', "%{$search}%")
                  ->orWhere('major', 'ilike', "%{$search}%");
        }

        $students = $query->latest()->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:students',
            'name' => 'required',
            'major' => 'required',
        ]);
        Student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Data Mahasiswa berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'nim' => 'required|unique:students,nim,' . $student->id,
            'name' => 'required',
            'major' => 'required',
        ]);
        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Data Mahasiswa berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Data Mahasiswa berhasil dihapus.');
    }
}
