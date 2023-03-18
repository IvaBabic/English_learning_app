<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SentenceLearner extends Model
{
    public function sentence()
    {
        return $this->belongsTo(Sentence::class);
    }
    public function learner()
    {
        return $this->belongsTo(Learner::class);
    }
}
