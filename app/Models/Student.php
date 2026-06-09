<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['nim', 'name', 'major'];

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }
}
