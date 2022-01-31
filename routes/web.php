<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
  });
  
Auth::routes();

/**
 * Authenticate  
 * */

Route::get('/login', 'AuthController@login')->middleware('guest')->name('login');
Route::post('/doLogin', 'AuthController@doLogin')->name('doLogin');
Route::get('/register', 'AuthController@register')->middleware('guest')->name('register');
Route::post('/doRegister', 'AuthController@doRegister')->name('doRegister');
Route::get('/logout', 'AuthController@logout')->name('logout');

/**
 * Route Panitia  
 * */

Route::group(['middleware' => ['auth', 'panitia']],function(){

    Route::get('panitia', 'Panitia\PanitiaController@index')->name('panitia.index');

    /*Read*/
    Route::get('panitia/datakriteria', 'Panitia\DataKriteriaController@index')->name('datakriteria.index');
      /*Create*/
    Route::get('panitia/datakriteria/create','Panitia\DataKriteriaController@create')->name('datakriteria.create');
    Route::post('panitia/datakriteria', 'Panitia\DataKriteriaController@store')->name('datakriteria.store');
    
    /*Update*/
    Route::get('panitia/datakriteria/{datakriteria}/edit', 'Panitia\DataKriteriaController@edit')->name('datakriteria.edit');
    Route::patch('panitia/datakriteria/{dataktiteria}', 'Panitia\DataKriteriaController@update')->name('datakriteria.update');
    
    Route::post('panitia/datakriteria/update-nilai-bobot', 'Panitia\DataKriteriaController@update_nilai_bobot_kriteria')->name('datakriteria.update-nilai-bobot-kriteria');
    
    //*** DELETE ***/
    Route::DELETE('panitia/datakriteria/{datakriteria}', 'Panitia\DataKriteriaController@destroy')->name('datakriteria.destroy');
  // Route::resource('/validasi', 'Panitia\ValidasiController');

    //DATA SOAL//
    /*Read*/
    Route::get('panitia/datasoal', 'Panitia\DataSoalController@index')->name('datasoal.index');
      /*Create*/
    Route::get('panitia/datasoal/create','Panitia\DataSoalController@create')->name('datasoal.create');
    Route::post('panitia/datasoal', 'Panitia\DataSoalController@store')->name('datasoal.store');
    
    /*Update*/
      Route::get('panitia/datasoal/{datasoal}/edit', 'Panitia\DataSoalController@edit')->name('datasoal.edit');
      Route::post('panitia/datasoal/{datasoal}', 'Panitia\DataSoalController@update')->name('datasoal.update');
  
      //*** DELETE ***/
      Route::DELETE('panitia/datasoal/{datasoal}', 'Panitia\DataSoalController@destroy')->name('datasoal.destroy');

      //Nilai//

      /*Create*/
      Route::get('panitia/nilai/create','Panitia\NilaiController@create')->name('nilai.create');
      Route::post('panitia/nilai', 'Panitia\NilaiController@store')->name('nilai.store');

      /*Update*/
      Route::get('panitia/nilai/{nilai}/edit', 'Panitia\NilaiController@edit')->name('nilai.edit');
      Route::patch('panitia/nilai/{nilai}', 'Panitia\NilaiController@update')->name('nilai.update');

      //*** DELETE ***/
      Route::DELETE('panitia/nilai/{nilai}', 'Panitia\NilaiController@destroy')->name('nilai.destroy');


      //VALIDASI//
            // Route::resource('/validasi', 'Panitia\ValidasiController');
      /*Read*/
      Route::get('panitia/validasi', 'Panitia\ValidasiController@index')->name('validasi.index');

      /*Update*/
      Route::post('panitia/validasi/{id}', 'Panitia\ValidasiController@update')->name('validasi.update');

});

/**********************************************/

/*ROUTE PENGURUS*/

Route::group(['middleware' => ['auth', 'pengurus']],function(){
    /*Read*/
    Route::get('pengurus', 'Pengurus\IndexController@index')->name('pengurus.index');

    // SOAL WAWANCARA//
    
    Route::get('pengurus/soal_wawancara', 'Pengurus\WawancaraController@soal_wawancara')->name('soal_wawancara.index');
    Route::get('pengurus/soal_wawancara/create','Pengurus\WawancaraController@soal_wawancara_create')->name('soal_wawancara.create');
    Route::post('pengurus/soal_wawancara/store', 'Pengurus\WawancaraController@soal_wawancara_store')->name('soal_wawancara.store');
    Route::get('pengurus/soal_wawancara/{id}/edit','Pengurus\WawancaraController@soal_wawancara_edit')->name('soal_wawancara.edit');
    Route::post('pengurus/soal_wawancara/{id}/update', 'Pengurus\WawancaraController@soal_wawancara_update')->name('soal_wawancara.update');
    Route::post('pengurus/soal_wawancara/{id}/delete', 'Pengurus\WawancaraController@soal_wawancara_delete')->name('soal_wawancara.delete');

    // WAWANCARA//

      /*Read*/
      Route::get('pengurus/wawancara', 'Pengurus\WawancaraController@index')->name('wawancara.index');
      /*Create*/
      Route::get('pengurus/wawancara/create/{id}','Pengurus\WawancaraController@create')->name('wawancara.create');
      Route::post('pengurus/wawancara/store', 'Pengurus\WawancaraController@store')->name('wawancara.store');
      // /*Update*/
      // Route::get('pengurus/wawancara/{wawancara}/edit', 'Pengurus\PembobotanController@edit')->name('datakriteria.edit');
      // Route::patch('pengurus/wawancara/{wawancara}', 'Pengurus\PembobotanController@update')->name('datakriteria.update');

      // //*** DELETE ***/
      // Route::DELETE('pengurus/wawancara/{wawancara}', 'Pengurus\PembobotanController@destroy')->name('datakriteria.destroy');

    // HASIL SELEKSI //

    /*Read*/
    Route::get('pengurus/hitung', 'Pengurus\HitungController@index')->name('hitung.index');
    Route::get('pengurus/mulai-hitung', 'Pengurus\HitungController@store')->name('hitung.mulai');
    Route::get('pengurus/grafik_nilai_kriteria/{id}', 'Pengurus\HitungController@grafik_nilai_kriteria')->name('hitung.grafik_nilai_kriteria');
    Route::get('pengurus/hasilseleksi', 'Pengurus\HasilSeleksiController@index')->name('hasilseleksi.index');
    /*Create*/
    Route::get('pengurus/hasilseleksi/create','Pengurus\HasilSeleksiController@create')->name('hasilseleksi.create');
    Route::post('pengurus/hasilseleksi', 'Pengurus\HasilSeleksiController@store')->name('hasilseleksi.store');

    Route::get('pengurus/semua_data_hasilseleksi', 'Pengurus\HasilSeleksiController@semua_data')->name('semua_data_hasilseleksi.index');
    Route::get('pengurus/filter_data_hasilseleksi', 'Pengurus\HasilSeleksiController@filter_data')->name('filter_data_hasilseleksi.index');

});

  

/**********************************************/

/*ROUTE Mahasiswa*/

Route::group(['middleware' => ['auth', 'mahasiswa']],function(){
    /*Read*/
    Route::get('mahasiswa', 'Mahasiswa\IndexController@index')->name('mahasiswa.index');


    //PENDAFTARAN//

    /*Read*/
    Route::get('mahasiswa/pendaftaran', 'Mahasiswa\PendaftaranController@index')->name('pendaftaran.index');

    /*Create*/
    Route::get('mahasiswa/pendaftaran/create','Mahasiswa\PendaftaranController@create')->name('pendaftaran.create');
    Route::post('mahasiswa/pendaftaran', 'Mahasiswa\PendaftaranController@store')->name('pendaftaran.store');

    //TES TULIS
    /*Read*/
    Route::get('mahasiswa/testulis', 'Mahasiswa\TesTulisController@index')->name('testulis.index');

    /*Create*/
    Route::post('mahasiswa/testulis/create', 'Mahasiswa\TesTulisController@store')->name('testulis.store');
    
    Route::get('mahasiswa/hasilseleksi', 'Mahasiswa\HasilSeleksiMhsController@index')->name('mahasiswa.hasilseleksi');
    Route::get('mahasiswa/grafik_nilai/{id}', 'Mahasiswa\HasilSeleksiMhsController@grafik_nilai')->name('mahasiswa.grafik_nilai');

});
