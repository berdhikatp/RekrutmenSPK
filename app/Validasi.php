<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    //
    protected $fillable = [
        'nim',
        'nama',
        'jenis_kelamin',
        'tmpt_lahir',
        'tgl_lahir',
        'semester',
        'alamat',
        'no_hp',
        'upload_foto',
        'upload_file',
        'status_validasi'

    ];
}
