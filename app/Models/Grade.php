<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'school_id'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
    public function subject()
    {
        return $this->hasMany(Subject::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function exam()
    {
        return $this->hasMany(Exam::class);
    }
    public function result()
    {
        return $this->hasMany(Result::class);
    }
}
