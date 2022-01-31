<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiWawancara extends Model
{
    protected $table = "nilai_wawancara";

    protected $fillable = [
        'id_user', 'nilai', 'jawaban_soal1', 'jawaban_soal2', 'jawaban_soal3', 'jawaban_soal4', 'jawaban_soal5',
        'jawaban_soal6', 'jawaban_soal7', 'jawaban_soal8', 'jawaban_soal9', 'jawaban_soal10',
    ];
}
