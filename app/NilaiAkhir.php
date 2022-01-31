<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiAkhir extends Model
{
    protected $table = "nilai_akhir";

    protected $fillable = [
        'id_user', 'nilai', 'status'
    ];
}
