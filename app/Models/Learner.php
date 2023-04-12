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

    protected $guard = 'learners';
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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
