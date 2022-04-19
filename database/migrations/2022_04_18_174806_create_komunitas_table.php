<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomunitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komunitas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_komunitas'); 
            $table->string('deskripsi');
            $table->string('pj'); 
            $table->string('kontak');    
            $table->string('cover')->nullable();
            $table->enum('status',['0','1']);        
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
        Schema::dropIfExists('komunitas');
    }
}