<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->timestamps();
        });

        DB::table('role')->insert(
            [[
                'role' => 'Panitia'
            ],[
                'role' => 'Pengurus'
            ],[
                'role' => 'Mahasiswa'
            ]]
        );

        // insert([  
        //     ['email' => 'taylor@example.com', 
        //     'votes' => 0],   
        //     ['email' => 'dayle@example.com',
        //     'votes' => 0] ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role');
    }
}
