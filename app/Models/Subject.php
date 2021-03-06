<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'mark',
        'grade_id',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    
    public function mark()
    {
        return $this->hasMany(Mark::class);
    }
}
