<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'birth_date',
        'guardian_name',
        'guardian_phone',
        'email',
        'class_id',
        'grade_id',
        'school_id',
    ];

    public function cls()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }
    
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    
    public function result()
    {
        return $this->hasMany(Result::class);
    }
}
