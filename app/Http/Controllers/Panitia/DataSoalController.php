<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataSoal;


class DataSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data_soal = DataSoal::paginate(10);
        return view('panitia.datasoal.index', compact('data_soal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('panitia.datasoal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'pertanyaan'=> ['required', 'string']
        ]);

        DataSoal::create($request->all());
        return redirect()->route('datasoal.index')->with('success','Data Soal Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data_soal = DataSoal::find($id);
        return view('panitia.datasoal.edit', compact('data_soal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'pertanyaan'=> ['required', 'string']
        ]);
        $data_soal= DataSoal::find($id)->update($request->all());
        smilify('success', 'Data Soal Berhasil Dirubah');

        return redirect()->route('datasoal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data_soal = DataSoal::find($id);
        $data_soal->delete();
        smilify('success', 'Data Soal Berhasil Dihapus');
        
        return redirect()->route('datasoal.index')->with('success','Data soal berhasil dihapus');
    }
}
