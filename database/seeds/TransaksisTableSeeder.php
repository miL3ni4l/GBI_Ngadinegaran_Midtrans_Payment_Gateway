<?php

use Illuminate\Database\Seeder;

class TransaksisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Transaksi::insert([
            [
              'id'  			=> 1,
              'kode_transaksi' 	=> 'TR0001',
              'ibadah_id'			=> 1,
              'kategori_id'			=> 1,
              'kas_id'			=> 1,
              'nama_pengguna'			=> 1,
              'status'			=> '1',
              'nominal'			=> '500000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'  			=> 2,
                'kode_transaksi' 	=> 'TR0001',
                'ibadah_id'			=> 2,
                'kategori_id'			=> 2,
                'kas_id'			=> 1,
                'nama_pengguna'			=> 2,
                'status'			=> '1',
                'nominal'			=> '1200000',
                'tanggal'      => \Carbon\Carbon::now(),
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}
