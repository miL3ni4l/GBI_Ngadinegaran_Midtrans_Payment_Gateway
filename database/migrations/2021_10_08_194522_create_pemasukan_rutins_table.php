<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemasukanRutinsTable extends Migration
{

    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
      
        Schema::create('pemasukan_rutin', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('ibadah_id')->unsigned();
            $table->foreign('ibadah_id')->references('id')->on('ibadah')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('kategori_id')->unsigned();
            $table->foreign('kategori_id')->references('id')->on('detail_kategori')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('kas_id')->unsigned();
            $table->foreign('kas_id')->references('id')->on('kas')->onDelete('cascade')->onUpdate('cascade');

            $table->string('nama_pengguna'); 
            $table->string('kode_pemasukan_rutin');      
            $table->date('tanggal');

            //Tipe data ENUM merupakan tipe data yang khusus 
            //untuk kolom dimana nilai datanya sudah kita tentukan sebelumnya.
            // Pilihan ini dapat berisi 1 sampai dengan 65,535 pilihan string.
            // Dimana kolom yang didefinisikan sebagai ENUM hanya dapat memilih satu diantara pilihan string yang tersedia.
            // $table->enum('jenis',['Pemasukan','Pengeluaran']);
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
        Schema::dropIfExists('pemasukan_rutin');
    }
}
