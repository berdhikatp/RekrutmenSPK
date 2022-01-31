<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiBobotKriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_bobot_kriterias', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('kriteria1_id');
            $table->unsignedBigInteger('kriteria2_id');
            $table->double('nilai');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kriteria1_id')->references('id')->on('data_kriterias');
            $table->foreign('kriteria2_id')->references('id')->on('data_kriterias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_bobot_kriterias');
    }
}
