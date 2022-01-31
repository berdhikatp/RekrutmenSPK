<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawabans', function (Blueprint $table) {
            $table->id();
            $table->string('jawaban');
            $table->integer('fk_soal_id')->unsigned(); 
            $table->integer('fk_pendaftaran_id')->unsigned();
            $table->timestamps();

            
            // $table->foreign('fk_soal_id')->references('id')->on('data_soals');
            // $table->foreign('fk_pendaftaran_id')->references('id')->on('pendaftarans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawabans');
    }
}
