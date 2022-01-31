<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiTesTulis extends Model
{
    protected $table = "nilai_tes_tulis";

    protected $fillable = [
        'id_user', 'id_kriteria', 'nilai'
    ];
}
