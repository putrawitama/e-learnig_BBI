<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'type', 'point', 'essay', 'checklists', 'answer_sheet_id', 'question_id',
    ];

    public function answer_sheet(){
        return $this->belongsTo('App\AnswerSheet');
    }

    public function question(){
        return $this->belongsTo('App\Question');
    }

    public function interview_form(){
        return $this->hasOne('App\InterviewForm');
    }
}
