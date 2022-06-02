<?php

use Illuminate\Database\Seeder;

class pemasukan_rutinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\pemasukan_rutin::insert([
            [
              'id'  			=> 1,
              'kode_pemasukan_rutin' 	=> 'TR0001',
              'ibadah_id'			=> 1,
              'kategori_id'			=> 1,
              'kas_id'			=> 1,
              'nama_pengguna'			=> 1,
              'status'			=> '1',
              'nominal'			=> '750000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'  			=> 2,
                'kode_pemasukan_rutin' 	=> 'TR0001',
                'ibadah_id'			=> 2,
                'kategori_id'			=> 2,
                'kas_id'			=> 1,
                'nama_pengguna'			=> 2,
                'status'			=> '1',
                'nominal'			=> '250000',
                'tanggal'      => \Carbon\Carbon::now(),
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}
