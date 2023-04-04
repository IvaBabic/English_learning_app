<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Summary of Learner
 */
class Learner extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * Summary of fillable
     * @var array
     */
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

    /**
     * Summary of sentence
     * @return mixed
     */
    public function sentence()
    {
        return $this->hasMany(Sentence::class, 'sentence_learners');
    }

    
}
