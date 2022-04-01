<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengeluaranKhusussTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran_khusus', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('kategori_id')->unsigned();
            $table->foreign('kategori_id')->references('id')->on('detail_kategori')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('kas_id')->unsigned();
            $table->foreign('kas_id')->references('id')->on('kas')->onDelete('cascade')->onUpdate('cascade');

            $table->string('nama_pengguna'); 
            $table->string('kode_transaksi');      
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
        Schema::dropIfExists('pengeluaran_khusus');
    }
}
