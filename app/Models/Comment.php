<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
        ];

    public function sentence(){
        return $this->belongsTo(Sentence::class);
    }

    public function Learner(){
        return $this->belongsTo(Learner::class);
    }

    public function Teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
