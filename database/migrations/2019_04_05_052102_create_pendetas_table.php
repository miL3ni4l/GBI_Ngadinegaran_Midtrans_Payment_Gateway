<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendetas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pendeta');
            $table->string('alias');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('tlp_pendeta');
            $table->string('istri');
            $table->string('pendidikan');
            $table->string('karir');
            $table->longText('biografi')->nullable();
            $table->longText('keterangan_pendeta')->nullable();
            $table->string('cover')->nullable();
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
        Schema::dropIfExists('pendetas');
    }
}
