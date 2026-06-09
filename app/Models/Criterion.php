<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    protected $fillable = ['code', 'name', 'type', 'weight'];

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }
}
