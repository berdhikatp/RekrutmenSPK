<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validasis', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('nim')->nullable();
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('tmpt_lahir');
            $table->date('tgl_lahir');
            $table->string('semester');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('upload_foto');
            $table->string('upload_file');
            $table->integer('status_validasi');
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
        Schema::dropIfExists('validasis');
    }
}
