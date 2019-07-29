<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [
        'name', 'tujuan', 'uraian', 'exam_threshold', 'evaluation_threshold',
    ];

    public function questions(){
        return $this->hasMany('App\Question');
    }

    public function case_studies(){
        return $this->hasMany('App\CaseStudy');
    }

    public function evaluations(){
        return $this->hasMany('App\Evaluation');
    }

    public function answer_sheets(){
        return $this->hasMany('App\AnswerSheet');
    }
}
