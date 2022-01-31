<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataSoal;
use App\NilaiTesTulis;
use App\Pendaftaran;
use DB;

class TesTulisController extends Controller
{
    //
    public function index()
    {
        $data_soal = Datasoal::all();

        $data_soal = collect($data_soal)->shuffle()->all();
        $pendaftaran = Pendaftaran::where('id_users', auth()->user()->id)->where('status', '>=', 2)->first();
        
        return view('mahasiswa.testulis',compact('data_soal', 'pendaftaran'));
    }

    public function store(Request $request)
    {
        $data = [];
        foreach ($request['soal'] as $key => $value) {
            if(!isset($data[$value]))
            $data[$value]=0;
            $data[$value]+=1;
        }
        
        $values = [];
        foreach($data as $k => $v) {

            $papi_roles = DB::table('papi_roles')
                ->where('id', $k)
                ->first();

            $values[] = [
                'papi_roles' => $k,
                'aspect_id' => $papi_roles->aspect_id,
                'nilai' => $v,
            ];
        }
        
        
        $values = collect($values)->SortBy('papi_roles')->groupBy('aspect_id')->toArray();
        
        foreach ($values as $k => $v) {
            // return $v;
            $nilai = 0;
            $b = 0;

            foreach ($v as $key => $value) {
                $nilai += $value['nilai'];
                $b += 1;
            }

            $val = [
                'id_user' => auth()->user()->id,
                'id_kriteria' => $v[0]['aspect_id'],
                'nilai' => round($nilai/$b, 0),
            ]; 

            NilaiTesTulis::create($val);
            // return $nilai;
        }

        $pendaftaran = Pendaftaran::where('id_users', auth()->user()->id)->first();

        $pendaftaran->update([
            'status' => 2
        ]);

        smilify('success', 'Jawaban anda berhasil disimpan, Silahkan melanjutkan ke tes berikutnya');
        return redirect()->route('testulis.index');
    }

}
