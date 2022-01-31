<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataSoal extends Model
{
    //
    protected $table = "papi_questions";
    protected $fillable =[
        'no', 'questions2',
        'questions1'
    ];
}
