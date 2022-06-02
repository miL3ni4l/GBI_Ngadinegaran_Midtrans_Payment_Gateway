<?php

use Illuminate\Database\Seeder;

class PengeluaranKhususTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\PengeluaranKhusus::insert([
            [
              'id'  			=> 1,
              'kategori_id'  			=> 4,
              'kas_id'  			=> 1,
              'nama_pengguna'  			=> 1,
              'kode_pemasukan_rutin'  			=> 'TK222',
              'status'  			=> '1',
              'nominal'  			=> '300000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 2,
              'kategori_id'  			=> 4,
              'kas_id'  			=> 2,
              'nama_pengguna'  			=> 1,
              'kode_pemasukan_rutin'  			=> 'TK222',
              'status'  			=> '1',
              'nominal'  			=> '700000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
              ]
        ]);
    }
}
