<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = [
        'point', 'body', 'correct', 'question_id',
    ];

    public function question(){
        return $this->belongsTo('App\Question');
    }
}
