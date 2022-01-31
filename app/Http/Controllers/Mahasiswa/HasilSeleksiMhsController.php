<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pendaftaran;
use App\DataKriteria;
use App\NilaiBobotKriteria;
use App\NilaiTesTulis;
use App\NilaiWawancara;
use App\User;

class HasilSeleksiMhsController extends Controller
{
    //
    public function index()
    {
        $data_pendaftaran = pendaftaran::where('id_users', auth()->user()->id)->get();

        return view('mahasiswa.hasilseleksi', compact('data_pendaftaran'));
    }

    public function grafik_nilai($id)
    {
        $tes_tulis = NilaiTesTulis::where('id_user', $id)->orderBy('id_kriteria', 'ASC')->get();

        $data_pendaftaran = pendaftaran::where('id_users', $id)->where('status', '3')->first();

        $nilai_tes_tulis [] = [
            $tes_tulis
        ];

        $kri = DataKriteria::orderBy('id', 'asc')->get();

        foreach ($nilai_tes_tulis as $key => $value) {

            $nilai = $value[0];
            foreach ($nilai as $k => $v) {
                
                $nilai_kriteria[] = $v->nilai;
            }

        }
        
        foreach ($kri as $key => $value) {
            $nama_kriteria [] = $value->nama_kriteria; 
        }

        return view('pengurus.grafik_nilai_kriteria', compact(
            'nama_kriteria', 'nilai_kriteria', 'nilai_tes_tulis', 'data_pendaftaran'
        ));

    }

}
