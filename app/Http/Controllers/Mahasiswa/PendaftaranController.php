<?php

namespace App\Http\Controllers\Mahasiswa;

use App\User;
use Carbon\Carbon;
use App\Pendaftaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pendaftaran = Pendaftaran::where('id_users', auth()->user()->id)->first();
        
        return view('mahasiswa.daftar', compact('pendaftaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'upload_foto'=> 'required|image|mimes:jpg,jpeg,png|max:2048',
            'upload_file'=> 'required|file|mimes:pdf,xlx,csv|max:2048',
        ]);
        
        // Mendapatkan nama dari file
        $imgName = time().'.'.auth()->user()->name.'.'.$request->upload_foto->extension();  
        $fileName = time().'.'.auth()->user()->name.'.'.$request->upload_file->extension();  

        // Memindahkan file ke folder public/uploads 
        $request->upload_foto->move(public_path('uploads'), $imgName);
        $request->upload_file->move(public_path('uploads'), $fileName);
        
        // Parsing data tanggal lahir
        $date = Carbon::createFromFormat('d/m/Y', $request->tgl_lahir)->format('Y/m/d');

        // Instance Objek Baru
        $pendaftaran = new Pendaftaran;

        // Assign nilai kedalam field
        $id_user = auth()->user()->id;
        $pendaftaran->id_users = $id_user;
        $pendaftaran->jenis_kelamin = $request['jenis_kelamin'];
        $pendaftaran->tmpt_lahir = $request['tmpt_lahir'];
        $pendaftaran->tgl_lahir = $date;
        $pendaftaran->semester = $request['semester'];
        $pendaftaran->alamat = $request['alamat'];
        $pendaftaran->no_hp = $request['no_hp'];
        $pendaftaran->upload_foto = $imgName;
        $pendaftaran->upload_file = $fileName;
        $pendaftaran->status = 1;
        $pendaftaran->save();

        $user = User::find(auth()->user()->id);
        $user->update([
            'status' => 1
        ]);
        // dd($pendaftaran);
        smilify('success', 'Selamat anda berhasil mendaftar');

        return redirect()->route('pendaftaran.create');
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
    }
}
