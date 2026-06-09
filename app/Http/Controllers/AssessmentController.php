<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Criterion;
use App\Models\Assessment;

class AssessmentController extends Controller
{
    public function index()
    {
        $students = Student::with('assessments')->get();
        $criteria = Criterion::orderBy('code')->get();

        // Organize existing assessments for easy view access
        $matrix = [];
        foreach ($students as $student) {
            foreach ($student->assessments as $assessment) {
                $matrix[$student->id][$assessment->criterion_id] = $assessment->value;
            }
        }

        return view('assessments.index', compact('students', 'criteria', 'matrix'));
    }

    public function store(Request $request)
    {
        $data = $request->input('values');
        
        if(!$data) {
            return back()->with('error', 'Tidak ada data yang dikirim.');
        }

        foreach ($data as $studentId => $criteriaValues) {
            foreach ($criteriaValues as $criterionId => $value) {
                if ($value !== null) {
                    Assessment::updateOrCreate(
                        ['student_id' => $studentId, 'criterion_id' => $criterionId],
                        ['value' => $value]
                    );
                }
            }
        }

        return redirect()->route('assessments.index')->with('success', 'Data Penilaian berhasil disimpan.');
    }
}
