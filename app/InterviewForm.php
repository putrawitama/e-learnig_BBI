<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterviewForm extends Model
{
    protected $fillable = [
        'full_name', 'date_of_birth', 'education', 'unit', 'position', 'interviewer', 'date_of_interview', 'result', 'type', 'user_id', 'answer_id'
    ];

    public function competencies(){
        return $this->hasMany('App\Competency');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function answer(){
        return $this->belongsTo('App\Answer');
    }
}
