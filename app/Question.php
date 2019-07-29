<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'number', 'body', 'answer_type', 'essay', 'score', 'level_id', 'case_study_id',
    ];
    
    public function choices(){
        return $this->hasMany('App\Choice');
    }

    public function level(){
        return $this->belongsTo('App\Level');
    }

    public function checklists(){
        return $this->hasMany('App\Checklist');
    }

    public function case_study(){
        return $this->belongsTo('App\CaseStudy');
    }

    public function answers(){
        return $this->hasMany('App\Answer');
    }
}
