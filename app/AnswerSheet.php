<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerSheet extends Model
{
    protected $fillable = [
        'finished', 'user_id', 'level_id',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function level(){
        return $this->belongsTo('App\Level');
    }

    public function answers(){
        return $this->hasMany('App\Answer');
    }

    public function evaluation_answers(){
        return $this->hasMany('App\EvaluationAnswer');
    }

    public function report(){
        return $this->hasOne('App\Report');
    }
}
