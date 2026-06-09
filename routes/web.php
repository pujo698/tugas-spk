<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DssController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CriterionController;
use App\Http\Controllers\AssessmentController;

Route::get('/', [DssController::class, 'dashboard'])->name('dashboard');

Route::post('students/import', [StudentController::class, 'import'])->name('students.import');
Route::resource('students', StudentController::class);
Route::resource('criteria', CriterionController::class);
Route::get('assessments', [AssessmentController::class, 'index'])->name('assessments.index');
Route::post('assessments', [AssessmentController::class, 'store'])->name('assessments.store');

Route::get('/calculation', [DssController::class, 'calculation'])->name('calculation');
