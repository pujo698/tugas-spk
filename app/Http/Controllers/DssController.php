<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Criterion;
use App\Models\Assessment;

class DssController extends Controller
{
    private function calculateSAW()
    {
        $students = Student::with('assessments')->get();
        $criteria = Criterion::all();
        
        $matrix = [];
        $normalizedMatrix = [];
        $finalScores = [];

        // 1. Matriks Keputusan Awal
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

        foreach ($students as $student) {
            $studentScore = 0;
            foreach ($criteria as $criterion) {
                $assessment = $student->assessments->where('criterion_id', $criterion->id)->first();
                $value = $assessment ? $assessment->value : 0;
                
                $matrix[$student->id][$criterion->id] = $value;

                // 2. Normalisasi
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

                // 3. Menghitung Nilai Preferensi (Hasil Akhir)
                $studentScore += ($normalizedValue * $criterion->weight);
            }
            $finalScores[$student->id] = [
                'student' => $student,
                'score' => $studentScore
            ];
        }

        // Urutkan berdasarkan skor tertinggi
        usort($finalScores, function ($item1, $item2) {
            return $item2['score'] <=> $item1['score'];
        });

        return [
            'students' => $students,
            'criteria' => $criteria,
            'matrix' => $matrix,
            'normalizedMatrix' => $normalizedMatrix,
            'finalScores' => $finalScores
        ];
    }

    public function dashboard()
    {
        $totalStudents = Student::count();
        $totalCriteria = Criterion::count();
        $totalAssessments = Assessment::count();
        
        $sawData = $this->calculateSAW();
        $topCandidates = array_slice($sawData['finalScores'], 0, 3);
        $bestCandidate = count($topCandidates) > 0 ? $topCandidates[0] : null;

        return view('dashboard', compact('totalStudents', 'totalCriteria', 'totalAssessments', 'topCandidates', 'bestCandidate'));
    }

    public function calculation()
    {
        $sawData = $this->calculateSAW();
        return view('calculation.index', $sawData);
    }
}
