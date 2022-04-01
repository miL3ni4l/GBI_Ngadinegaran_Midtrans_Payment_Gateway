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
              'kategori_id'  			=> 3,
              'kas_id'  			=> 1,
              'nama_pengguna'  			=> 1,
              'kode_transaksi'  			=> 'TK222',
              'status'  			=> '1',
              'nominal'  			=> '2000000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 2,
              'kategori_id'  			=> 3,
              'kas_id'  			=> 2,
              'nama_pengguna'  			=> 1,
              'kode_transaksi'  			=> 'TK222',
              'status'  			=> '1',
              'nominal'  			=> '750000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
              ]
        ]);
    }
}
