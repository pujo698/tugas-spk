<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = ['student_id', 'criterion_id', 'value'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function criterion()
    {
        return $this->belongsTo(Criterion::class);
    }
}
