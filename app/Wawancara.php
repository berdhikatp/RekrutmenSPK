<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wawancara extends Model
{
    protected $table = "soal_wawancara";
    protected $fillable = [
        'pertanyaan'
    ];
    
}
