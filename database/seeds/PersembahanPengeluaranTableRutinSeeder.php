<?php

use Illuminate\Database\Seeder;

class PersembahanPengeluaranRutinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\PersembahanPengeluaranRutin::insert([
            [
              'id'  			=> 1,
              'kategori_id'  			=> 2,
              'detail_pengeluaran'  			=> 1,
              'nama_pengguna'  			=> 1,
              'kode_persembahan_pengeluaran_rutin'  			=> 'TK122',
              'status'  			=> '1',
              'nominal'  			=> '100000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}
