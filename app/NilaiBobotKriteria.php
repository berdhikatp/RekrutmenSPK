<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiBobotKriteria extends Model
{
    //
    
    public $fillable = [
        'kriteria1_id',
        'kriteria2_id',
        'nilai'
    ];

    public function kriteria1()
    {
        return $this->belongsTo('App\DataKriteria', 'kriteria1_id');
    }
    public function kriteria2()
    {
        return $this->belongsTo('App\DataKriteria', 'kriteria2_id');
    }
}
