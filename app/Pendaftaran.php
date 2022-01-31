<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    //
    protected $fillable = [
        'id_users',
        'jenis_kelamin',
        'tmpt_lahir',
        'tgl_lahir',
        'semester',
        'alamat',
        'no_hp',
        'upload_foto',
        'upload_file',
        'status',
        'nilai_akhir'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_users');
    }

    public function ambilFoto() 
    {
        if(!$this->upload_foto){
            return asset('/uploads/a.png');
        }else{
            return asset('/uploads/'.$this->upload_foto);
        }
    }

    public function ambilFile() 
    {
        if(!$this->upload_file){
            return asset('/uploads/a.png');
        }else{
            return asset('/uploads/'.$this->upload_file);
        }
    }
}
