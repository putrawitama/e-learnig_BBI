<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluationAnswer extends Model
{
    protected $fillable = [
        'answer', 'answer_sheet_id', 'evaluation_id',
    ];

    public function answer_sheet(){
        return $this->belongsTo('App\AnswerSheet');
    }

    public function evaluation(){
        return $this->belongsTo('App\Evaluation');
    }
}
