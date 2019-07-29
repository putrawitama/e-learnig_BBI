<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'number', 'body', 'level_id'
    ];

    public function level(){
        return $this->belongsTo('App\Level');
    }
}
