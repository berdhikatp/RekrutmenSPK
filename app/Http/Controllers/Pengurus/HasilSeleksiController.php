<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pendaftaran;
use DB;

class HasilSeleksiController extends Controller
{
    //
    public function index()
    {
        $pendaftaran = Pendaftaran::whereYear('created_at', date('Y'))->where('status', 3)->orderBy('nilai_akhir', 'Desc')->get();
        return view('pengurus.hasilseleksi.index', compact('pendaftaran'));
    }

    public function semua_data(Request $request)
    {
        $tahun_angkatan = Pendaftaran::where('status', 3)->select([
            DB::raw('count(id) as `count`'), 
            DB::raw('Year(created_at) as year')
            ])->groupBy('year')
            ->orderBy('year', 'Desc')
            ->get();

        $thn_pilihan = $request->tahun;

        // Fungsi Filter
        $pendaftaran = Pendaftaran::whereYear('created_at', 'like', '%' . $request->tahun . '%')->where('status', 3)->orderBy('nilai_akhir', 'Desc')->get();

        return view('pengurus.hasilseleksi.semua_data', compact('pendaftaran', 'tahun_angkatan', 'thn_pilihan'));
    }


}
