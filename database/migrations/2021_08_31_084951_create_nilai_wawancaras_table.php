<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiWawancarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_wawancara', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->double('nilai');
            $table->string('jawaban_soal1')->nullable();
            $table->string('jawaban_soal2')->nullable();
            $table->string('jawaban_soal3')->nullable();
            $table->string('jawaban_soal4')->nullable();
            $table->string('jawaban_soal5')->nullable();
            $table->string('jawaban_soal6')->nullable();
            $table->string('jawaban_soal7')->nullable();
            $table->string('jawaban_soal8')->nullable();
            $table->string('jawaban_soal9')->nullable();
            $table->string('jawaban_soal10')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_wawancara');
    }
}
