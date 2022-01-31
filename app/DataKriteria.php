<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataKriteria extends Model
{
    //
    protected $fillable =[
        'id_kriteria', 'kode',
        'nama_kriteria'
    ];
}
