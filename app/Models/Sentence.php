<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'level'
        
    ];

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function sentence()
    {
        return $this->belongsToMany(Learner::class, 'sentence_learners');
    }
}
