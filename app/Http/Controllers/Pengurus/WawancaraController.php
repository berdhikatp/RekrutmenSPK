<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pendaftaran;
use App\DataKriteria;
use App\DataSoal;
use App\NilaiWawancara;
use App\Wawancara;

class WawancaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pendaftaran = Pendaftaran::where('status', 2)->orderBy('id', 'DESC')->get();
        return view('pengurus.wawancara.index', compact('pendaftaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::find($id); 
        
        $soal_wawancara = Wawancara::all();
        return view('pengurus.wawancara.create', compact('pendaftaran', 'soal_wawancara'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $soal_wawancara = Wawancara::count();
        
        $nilai = ($request->nilai_wawancara1 + $request->nilai_wawancara2 + $request->nilai_wawancara3 + $request->nilai_wawancara4 + $request->nilai_wawancara5
                + $request->nilai_wawancara6 + $request->nilai_wawancara7 + $request->nilai_wawancara8 + $request->nilai_wawancara9 + $request->nilai_wawancara10) / $soal_wawancara;

        $nilai = round($nilai, 3);

        $data = [
            'id_user' => $request->id_user,
            'nilai' => $nilai,
            'jawaban_soal1' => $request->soal_wawancara1,
            'jawaban_soal2' => $request->soal_wawancara2,
            'jawaban_soal3' => $request->soal_wawancara3,
            'jawaban_soal4' => $request->soal_wawancara4,
            'jawaban_soal5' => $request->soal_wawancara5,
            'jawaban_soal6' => $request->soal_wawancara6,
            'jawaban_soal7' => $request->soal_wawancara7,
            'jawaban_soal8' => $request->soal_wawancara8,
            'jawaban_soal9' => $request->soal_wawancara9,
            'jawaban_soal10' => $request->soal_wawancara10,
            
        ];

        NilaiWawancara::create($data);

        $pendaftaran = Pendaftaran::where('id_users', $request->id_user)->first();

        $pendaftaran->update([
            'status' => 3
        ]);

        smilify('success', 'Data Berhasil disimpan');

        return redirect()->route('wawancara.index');

    }

    public function soal_wawancara()
    {
        $data = Wawancara::all();

        return view('pengurus.soal_wawancara.index', compact('data'));
    }

    public function soal_wawancara_create()
    {
        return view('pengurus.soal_wawancara.create');
    }

    public function soal_wawancara_store(Request $request)
    {
        $data = [
            'pertanyaan' => $request->pertanyaan
        ];

        Wawancara::create($data);

        smilify('success', 'Data Berhasil disimpan');

        return redirect()->route('soal_wawancara.index');
    }

    public function soal_wawancara_edit($id)
    {
        $data = Wawancara::find($id);

        return view('pengurus.soal_wawancara.edit', compact('data'));
    }

    public function soal_wawancara_update(Request $request, $id)
    {
        $soal_wawancara = Wawancara::find($id);

        $data = [
            'pertanyaan' => $request->pertanyaan
        ];

        $soal_wawancara->update($data);

        smilify('success', 'Data Berhasil diubah');

        return redirect()->route('soal_wawancara.index');
    }

    public function soal_wawancara_delete($id)
    {
        $soal_wawancara = Wawancara::find($id);

        $soal_wawancara->delete();

        smilify('success', 'Data Berhasil dihapus');

        return redirect()->route('soal_wawancara.index');
    }
}
