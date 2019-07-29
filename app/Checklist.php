<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = [
        'body', 'answer', 'question_id'
    ];

    public function question(){
        return $this->belongsTo('App\Question');
    }
}
