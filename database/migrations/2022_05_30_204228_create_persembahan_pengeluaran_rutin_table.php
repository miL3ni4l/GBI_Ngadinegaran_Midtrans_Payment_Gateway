<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersembahanPengeluaranRutinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persembahan_pengeluaran_rutin', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kategori_id')->unsigned();
            $table->foreign('kategori_id')->references('id')->on('detail_kategori')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('detail_pengeluaran')->unsigned()->nullable();
            $table->foreign('detail_pengeluaran')->references('id')->on('detail_pengeluaran')->onDelete('cascade')->onUpdate('cascade');


            $table->string('nama_pengguna'); 
            $table->string('kode_persembahan_pengeluaran_rutin');      
            $table->date('tanggal');

            //Tipe data ENUM merupakan tipe data yang khusus 
            //untuk kolom dimana nilai datanya sudah kita tentukan sebelumnya.
            // Pilihan ini dapat berisi 1 sampai dengan 65,535 pilihan string.
            // Dimana kolom yang didefinisikan sebagai ENUM hanya dapat memilih satu diantara pilihan string yang tersedia.
            $table->enum('status',['0','1']);
            $table->bigInteger('nominal');
            $table->string('cover')->nullable();
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('persembahan_pengeluaran_rutin');
    }
}
