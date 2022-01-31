<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_role');
            $table->string('nim')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status')->default('0');
            // $table->rememberToken();
            $table->timestamps();

            
            $table->foreign('id_role')
                    ->references('id')
                    ->on('role');
        });

        
        DB::table('users')->insert(
            [[
                'id_role' => '1',
                'name' => 'Panitia',
                'email' => 'panitia@gmail.com',
                'password' => bcrypt('1234567'),
            ],[
                'id_role' => '2',
                'name' => 'Pengurus',
                'email' => 'pengurus@gmail.com',
                'password' => bcrypt('1234567'),
            ],[
                'id_role' => '3',
                'name' => 'Mahasiswa',
                'email' => 'mahasiswa@gmail.com',
                'password' => bcrypt('1234567'),
            ]]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
