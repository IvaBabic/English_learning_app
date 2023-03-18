<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learner extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'level'
    ];

    // public function user(){
    //     return $this->belongsTo(User::class);
    // }

    public function sentence()
    {
        return $this->hasMany(Sentence::class, 'sentence_learners');
    }

    
}
