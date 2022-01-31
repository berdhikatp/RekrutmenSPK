<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataKriteria;
use App\NilaiBobotKriteria;

class DataKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_kriteria = DataKriteria::all();
        $distinct = NilaiBobotKriteria::orderBy('kriteria1_id', 'asc')->distinct()->get('kriteria1_id');

        $nilai_tfn = [];
        $detail_nilai = [];
        $d_nilai = [];
        $d2_nilai = [];
        $data_d2 = [];
        $rata_rata = [];
        $ri = 0;
        $ci = 0;
        $cr = 0;

        foreach ($distinct as $key => $value) {

            $nilai_bobot = NilaiBobotKriteria::orderBy('kriteria1_id', 'asc')->where('kriteria1_id', $value->kriteria1_id)->get();

            $nilai_tfn[] = [
                'name' => $nilai_bobot[0]->id,
                'id' => $nilai_bobot[0]->id,
                'kriteria1_id' => $nilai_bobot[0]->kriteria1_id,
                'kode_kriteria' => $nilai_bobot[0]->kriteria1->kode,
            ];
        }
        
        foreach ($nilai_tfn as $key => $val) {

            $nilai_bobot = NilaiBobotKriteria::orderBy('kriteria1_id', 'asc')
                        ->orderBy('kriteria2_id', 'asc')
                        ->where('kriteria1_id', $val['kriteria1_id']
                        )->get();
            
            $nilai_baris = [];
            foreach ($nilai_bobot as $key => $v) {
                
                $nilai_baris[] = [
                        'kriteria2_id' => $v['kriteria2_id'],
                        'nilai' => round($v['nilai'],3),
                    ];
            }

            $detail_nilai[] = [
                'kriteria1_id' => $val['kriteria1_id'],
                'kode_kriteria' => $val['kode_kriteria'],
                'detail_nilai' => $nilai_baris
            ];
            
        }

        foreach ($detail_nilai as $key => $value) {
            # code...
            $d_nilai[] = $value['detail_nilai'];

        }

        foreach ($detail_nilai as $key => $value) {
            # code...
            
            $d2_nilai[] = $value['detail_nilai'];
            // return $d2_nilai;

            foreach ($d2_nilai[$key] as $ke => $val) {
                # code...
                // return $val[2];
                $jumlah_kriteria2 = NilaiBobotKriteria::where('kriteria2_id', $d2_nilai[$key][$ke]['kriteria2_id'])->sum('nilai');
                // $jumlah_kriteria2 = round($jumlah_kriteria2, 2);
                
                // return $jumlah_kriteria2;
                $nilai_normalisasi = $val['nilai'] / $jumlah_kriteria2;
                $nilai_normalisasi = round($nilai_normalisasi, 3);
                $data_d2[] = [
                    'kriteria2_id' => $val['kriteria2_id'],
                    'nilai_normalisasi' => $nilai_normalisasi,
                ];
            }
            
        }

        $eigen = collect($data_d2)->chunk($data_kriteria->count());

        foreach ($eigen as $key => $value) {
            $total = collect($value)->sum('nilai_normalisasi');
            $rata2 = round($total/$data_kriteria->count(), 3);
            
            $rata_rata []= [
                'rata_rata' => $rata2
            ];
        }

        $lamda_max = 0;
        foreach ($detail_nilai as $key => $value) {
            # code...
            
            $c[] = $value['detail_nilai'];
            foreach ($c[$key] as $ke => $val) {
                # code...
                // return $val[2];
                $jumlah_kriteria2 = NilaiBobotKriteria::where('kriteria2_id', $c[0][$ke]['kriteria2_id'])->sum('nilai');
                // $jumlah_kriteria2 = round($jumlah_kriteria2, 2);

                $lamda = ($jumlah_kriteria2 * $rata_rata[$ke]['rata_rata']);
                // $lamda = round($lamda, 3);
                $lamda_max += $lamda;
                
            }

            if (count($data_kriteria) >= 2) {
                # code...
                $ci =  ($lamda_max - $data_kriteria->count())/($data_kriteria->count() - 1);
                $ci2[] = [
                    'lamda_max' => $ci
                ];
            }
            
        }

        $nilai = NilaiBobotKriteria::all();
        $kri1 = DataKriteria::orderBy('id', 'asc')->get();
        $kri2 = $kri1;
        $kri3 = $kri1;
        $kri4 = $kri1;
        // return $kri2;

        $ratio_index = collect([
            ['id'=> 1, 'nilai' => 0],
            ['id'=> 2, 'nilai' => 0],
            ['id'=> 3, 'nilai' => 0.58],
            ['id'=> 4, 'nilai' => 0.98],
            ['id'=> 5, 'nilai' => 1.12],
            ['id'=> 6, 'nilai' => 1.24],
            ['id'=> 7, 'nilai' => 1.32],
            ['id'=> 8, 'nilai' => 1.41],
            ['id'=> 9, 'nilai' => 1.45],
            ['id'=> 10, 'nilai' => 1.49],
            ['id'=> 11, 'nilai' => 1.51],
            ['id'=> 12, 'nilai' => 1.48],
            ['id'=> 13, 'nilai' => 1.56],
            ['id'=> 14, 'nilai' => 1.57],
            ['id'=> 15, 'nilai' => 1.59],
        ]);

        if ($data_kriteria->count() >= 2) {
            $matriks = $data_kriteria->count();
            $ri = $ratio_index->where('id', $matriks);
            $ri = $ri[$matriks - 1]['nilai'];
            
            $ci = $ci2[0]['lamda_max'];
            $ci = round($ci,3);
            if (count($data_kriteria) >= 3) {
                $cr = $ci/$ri;
                $cr = round($cr, 3);
            }
        };
        
        // return $d_nilai;
        // return $nilai_tfn;
        $skala_tfn = collect([
            ['id' => 1, 'perbandingan' => 'Sama Penting'],
            ['id' => 2, 'perbandingan' => 'Mendekati sedikit lebih penting'],
            ['id' => 3, 'perbandingan' => 'Sedikit lebih penting'],
            ['id' => 4, 'perbandingan' => 'Mendekati lebih penting'],
            ['id' => 5, 'perbandingan' => 'Lebih penting'],
            ['id' => 6, 'perbandingan' => 'Mendekati Sangat Penting'],
            ['id' => 7, 'perbandingan' => 'Sangat Penting'],
            ['id' => 8, 'perbandingan' => 'Mendekati mutlak'],
            ['id' => 9, 'perbandingan' => 'Mutlak Sangat Penting'],
        ]);

        // foreach ($skala_tfn as $key => $value) {
        //     return $value['id'];
        // }

        return view('panitia.datakriteria.index', 
                compact('data_kriteria','nilai', 'kri1', 'detail_nilai', 'd_nilai', 'd2_nilai',
                        'kri2','kri3', 'kri4', 'skala_tfn', 'distinct', 'nilai_tfn',
                        'data_d2', 'eigen', 'rata_rata', 'ri', 'ci', 'cr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('panitia.datakriteria.create');
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
        $data_kriteria = DataKriteria::all();
        $request->validate([
            'kode'=> ['required','string'],
            'nama_kriteria'=> ['required','string'],
        ]);

        return $data_kriteria;

        $last_id = DataKriteria::create($request->all())->id;
        
        NilaiBobotKriteria::create([
            'kriteria1_id' => $last_id, 
            'kriteria2_id' => $last_id, 
            'nilai' => 1,
        ]);

        foreach ($data_kriteria as $key => $value) {
            $data = [
                'kriteria1_id' => $value->id, 
                'kriteria2_id' => $last_id, 
                'nilai' => 1,
            ];
            NilaiBobotKriteria::create($data);
            $data2 = [
                'kriteria1_id' => $last_id, 
                'kriteria2_id' => $value->id, 
                'nilai' => 1,
            ];
            NilaiBobotKriteria::create($data2);
        }

            smilify('success', 'Data kriteria berhasil ditambahkan');
            return redirect()->route('datakriteria.index');

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
        $data_kriteria = DataKriteria::find($id);
        return view('panitia.datakriteria.edit', compact('data_kriteria'));
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
            'nama_kriteria'=> ['required','string']
        ]);

        $data_kriteria = DataKriteria::find($id)->update($request->all());
        smilify('success', 'Data kriteria berhasil diubah');

        return redirect()->route('datakriteria.index');
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
        // dd($data_kriteria);
        $data_kriteria = DataKriteria::find($id);
        $data_nilai_bobot_kriteria1 = NilaiBobotKriteria::where('kriteria1_id', $id)->delete();
        $data_nilai_bobot_kriteria2 = NilaiBobotKriteria::where('kriteria2_id', $id)->delete();
        $data_kriteria->delete();
        smilify('success', 'Data berhasil dihapus');

        return redirect()->route('datakriteria.index');
    }

    public function update_nilai_bobot_kriteria(Request $request)
    {
        $nilai_bobot = NilaiBobotKriteria::where('kriteria1_id', $request->kriteria1_id)->where('kriteria2_id', $request->kriteria2_id)->first();
        $data = [
            'nilai' => $request->skala_tfn
        ];
        
        $nilai_bobot2 = NilaiBobotKriteria::where('kriteria2_id', $request->kriteria1_id)->where('kriteria1_id', $request->kriteria2_id)->first();
        // return $nilai_bobot2;
        $data2 = [
            'nilai' => 1/$request->skala_tfn
        ];

        $nilai_bobot->update($data);
        $nilai_bobot2->update($data2);

        smilify('success', 'Data berhasil diubah');

        return redirect()->back();
    }
}
