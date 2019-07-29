<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'score', 'answer_sheet_id'
    ];
    
    public function answer_sheet(){
        return $this->belongsTo('App\AnswerSheet');
    }
}
