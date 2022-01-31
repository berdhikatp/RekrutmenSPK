<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pendaftaran;
use App\DataKriteria;
use App\NilaiBobotKriteria;
use App\NilaiTesTulis;
use App\NilaiWawancara;
use App\User;

class HitungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data_pendaftaran = pendaftaran::whereYear('created_at', date('Y'))->where('status', '3')->get();
        $hitung_mulai = null;

        $kri = DataKriteria::orderBy('id', 'asc')->get();

        $nilai_kriteria = [];
        foreach ($kri as $key => $value) {
            $nama_kriteria [] = $value->nama_kriteria; 
        }

        return view('pengurus.hitung', compact('data_pendaftaran', 'hitung_mulai', 'nama_kriteria', 'nilai_kriteria'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_pendaftaran = pendaftaran::whereYear('created_at', date('Y'))->where('status', '3')->get();

        $hitung_mulai = $request->hitung;
        $data_kriteria = DataKriteria::all();
        $data_kriteria_tot = $data_kriteria->count();
        $distinct = NilaiBobotKriteria::orderBy('kriteria1_id', 'asc')->distinct()->get('kriteria1_id');
        $nilai_tfn = [];
        $detail_nilai = [];
        $d_nilai = [];
        $d_nilai_lmu = [];
        $d2_nilai = [];
        $data_d2 = [];
        $rata_rata = [];
        $ri = 0;
        $ci = 0;
        $cr = 0;

        foreach ($distinct as $key => $value) {

            $nilai_bobot = NilaiBobotKriteria::orderBy('kriteria1_id', 'asc')->where('kriteria1_id', $value->kriteria1_id)->get();

            $kriteria = DataKriteria::find($nilai_bobot[0]->kriteria1_id);

            $nilai_tfn[] = [
                'nama' => $kriteria->nama_kriteria,
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
            $nilai_baris_lmu = [];
            foreach ($nilai_bobot as $key => $v) {
                
                $nilai_baris[] = [
                        'kriteria2_id' => $v['kriteria2_id'],
                        'nilai' => round($v['nilai'],3),
                    ];

                if ($v['nilai'] == 1) {
                    $nilai_baris_lmu[] = [
                            'kriteria2_id' => $v['kriteria2_id'],
                            'nilai_l' => round($v['nilai'],2),
                            'nilai_m' => round($v['nilai'],2),
                            'nilai_u' => round($v['nilai'],2),
                        ];
                }elseif ($v['nilai'] >= 1) {
                    $nilai_baris_lmu[] = [
                            'kriteria2_id' => $v['kriteria2_id'],
                            'nilai_l' => (round($v['nilai'],2) - 1 ) / 2,
                            'nilai_m' => round($v['nilai'],2) / 2,
                            'nilai_u' => (round($v['nilai'],2) + 1 ) / 2,
                        ];
                } else {
                    
                    // Reciprocal
                    $m = $v['nilai'] * 2;
                    $l = ((1 / $m) * 2) - 1 ;
                    $u = ((1 / $m) * 2) + 1 ;
                    
                    $nilai_baris_lmu[] = [
                            'kriteria2_id' => $v['kriteria2_id'],
                            'nilai_l' => round(1 / ($u / 2) , 2),
                            'nilai_m' => round($m,2),
                            'nilai_u' => round(1 / ($l / 2) , 2),
                        ];
                }
            }

            $detail_nilai[] = [
                'kriteria1_id' => $val['kriteria1_id'],
                'kode_kriteria' => $val['kode_kriteria'],
                'detail_nilai' => $nilai_baris,
                'detail_nilai_lmu' => $nilai_baris_lmu,
            ];
            
        }

        foreach ($detail_nilai as $key => $value) {
            # code...
            $d_nilai[] = $value['detail_nilai'];
            $d_nilai_lmu[] = $value['detail_nilai_lmu'];

        }

        foreach ($d_nilai_lmu as $key => $value) {
            $jumlah_baris_l = 0;
            $jumlah_baris_m = 0;
            $jumlah_baris_u = 0;
            foreach ($value as $k => $v) {
                // return $v['nilai_l'];
                $jumlah_baris_l += $v['nilai_l'];
                $jumlah_baris_m += $v['nilai_m'];
                $jumlah_baris_u += $v['nilai_u'];
            }

            $jumlah_baris[] = [
                'jumlah_l' => $jumlah_baris_l,
                'jumlah_m' => $jumlah_baris_m,
                'jumlah_u' => $jumlah_baris_u,
            ];
        }

        $total_l = 0;
        $total_m = 0;
        $total_u = 0;
        
        foreach ($jumlah_baris as $key => $value) {
            $total_l += $value['jumlah_l'];
            $total_m += $value['jumlah_m'];
            $total_u += $value['jumlah_u'];

            $total_baris = [
                'total_l' => round($total_l, 2),
                'total_m' => round($total_m, 2),
                'total_u' => round($total_u, 2),
            ];
        }

        $geoman_l = 1 / $total_baris['total_l'];
        $geoman_m = 1 / $total_baris['total_m'];
        $geoman_u = 1 / $total_baris['total_u'];

        foreach ($jumlah_baris as $key => $value) {
            $nilai_sintesis[] = [
                'nilai_si_l' => round($geoman_u * $value['jumlah_l'], 3),
                'nilai_si_m' => round($geoman_m * $value['jumlah_m'], 3),
                'nilai_si_u' => round($geoman_l * $value['jumlah_u'], 3),
            ];
        }

        // return $nilai_sintesis;

        foreach ($nilai_sintesis as $key => $value) {
            
            $perbandingan_defuzzy = collect($nilai_sintesis);
            $splice = $perbandingan_defuzzy->splice($key, 1);

            $perbandingan_defuzzy = $perbandingan_defuzzy->all();
            $defuzzy = [];
            foreach ($perbandingan_defuzzy as $k => $val) {
                // return $nilai_sintesis[$key]['nilai_si_u'];
                $defuzzy_a = $val['nilai_si_l'] - $nilai_sintesis[$key]['nilai_si_u'];
                $defuzzy_b = $nilai_sintesis[$key]['nilai_si_m'] - $nilai_sintesis[$key]['nilai_si_u'];
                $defuzzy_c = $val['nilai_si_m'] - $val['nilai_si_l'];
                $defuzzy_d = $defuzzy_b - $defuzzy_c;
                $defuzzy_e = $defuzzy_a / $defuzzy_d;

                if ($defuzzy_e <= 0) {
                    $defuzzy_e = 0;
                } elseif($defuzzy_e >= 1){
                    $defuzzy_e = 1;
                }

                $defuzzy[] = [
                    'nilai' => round($defuzzy_e, 3),
                ];
                
            }

            $defuzzy_min = collect($defuzzy)->min();
            $defuzzy = collect($defuzzy)->implode('nilai', ', ');
            // return $defuzzy_min;
            $defuzzifikasi[] = [
                $defuzzy,
            ];
            $defuzzifikasi_min[] = [
                $defuzzy_min,
            ];

        }

        $bobot_vektor_tot = collect($defuzzifikasi_min)->collapse()->sum('nilai');
        
        foreach ($defuzzifikasi_min as $key => $value) {
            // return $value[0]['nilai'];
            $normalisasi_bobot_vektor[] = [
                'nilai_normalisasi' => round($value[0]['nilai'] / $bobot_vektor_tot, 3),
            ];
        }

        $total_baris = [$total_baris];
        $jumlah_baris = collect($jumlah_baris)->chunk(1);
        $nilai_sintesis = collect($nilai_sintesis)->chunk(1);

        foreach ($detail_nilai as $key => $value) {
            
            $d2_nilai[] = $value['detail_nilai'];
            // return $d2_nilai[0];

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

        $eigen = collect($data_d2)->chunk($data_kriteria_tot);
        // return $eigen;

        foreach ($eigen as $key => $value) {
            $total = collect($value)->sum('nilai_normalisasi');
            $rata2 = round($total/$data_kriteria_tot, 3);
            
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
                $ci =  ($lamda_max - $data_kriteria_tot)/($data_kriteria_tot - 1);
                $ci2[] = [
                    'lamda_max' => $ci
                ];
            }
            
        }

        //Alternatif (Mahasiswa yg sudah melaksanakan tes wawancara)
        $alternatif = Pendaftaran::whereYear('created_at', date('Y'))->where('status', 3)->get();

        //Nilai tes tulis
        foreach ($alternatif as $key => $value) {
            
            $tes_tulis = NilaiTesTulis::where('id_user', $value->id_users)->orderBy('id_kriteria', 'ASC')->get();
            $wawancara = NilaiWawancara::where('id_user', $value->id_users)->first();

            $nilai_tot_alternatif = [];
            foreach ($tes_tulis as $k => $v) {
                
                foreach ($normalisasi_bobot_vektor[$k] as $item) {
                    // return $item;
                    
                    $tot = $v->nilai * $item;
                }

                $nilai_tot_alternatif[] = [
                    $tot
                ];
            }

            $nilai_akhir = collect($nilai_tot_alternatif)->collapse()->sum() + $wawancara->nilai;

            $pendaftarans = Pendaftaran::where('id_users', $value->id_users)->first();
            $user = User::find($value->id_users);
            $user->update([
                'status' => 4
            ]);
            
            $pendaftarans->update([
                'nilai_akhir' => $nilai_akhir
            ]);

            $nilai_tes_tulis [] = [
                $tes_tulis
            ];
            $nilai_wawancara [] = [
                $wawancara
            ];
            
            $total_nilai_akhir[] = [
                $nilai_akhir
            ];
        }

        $nilai = NilaiBobotKriteria::all();
        $kri1 = DataKriteria::orderBy('id', 'asc')->get();
        $kri2 = $kri1;
        $kri3 = $kri1;
        $kri4 = $kri1;
        $kri5 = $kri1;

        foreach ($nilai_tes_tulis as $key => $value) {

            $n = collect($value[0]);
            $n_kriteria = $n->implode('nilai', ', ');

            $nilai_kriteria[] = $n_kriteria;
        }
        
        foreach ($kri5 as $key => $value) {
            $nama_kriteria [] = $value->nama_kriteria; 
        }

        return view('pengurus.hitung', compact(
            'data_pendaftaran', 'nilai_tfn', 'kri1', 'kri3', 'd_nilai', 'd_nilai_lmu',
            'hitung_mulai', 'kri4', 'kri5', 'jumlah_baris', 'data_kriteria_tot', 'total_baris',
            'nilai_sintesis', 'defuzzifikasi', 'defuzzifikasi_min', 'normalisasi_bobot_vektor',
            'alternatif', 'nilai_tes_tulis', 'nilai_wawancara', 'total_nilai_akhir', 'nama_kriteria',
            'nilai_kriteria'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function grafik_nilai_kriteria($id)
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
