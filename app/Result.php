<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'stud_id', 'ques_id', 'answer', 'status',
    ];
    protected $table="result";
}
