<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competency extends Model
{
    protected $fillable = [
        'competency', 'score', 'evidence', 'interview_form_id'
    ];

    public function interview_form(){
        return $this->belongsTo('App\InterviewForm');
    }
}
