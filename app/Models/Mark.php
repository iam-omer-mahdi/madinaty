<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    protected $fillable = [
        'result_id',
        'subject_id',
        'mark',
    ];

    public function result()
    {
        return $this->belongsTo(Result::class);
    }
    
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
