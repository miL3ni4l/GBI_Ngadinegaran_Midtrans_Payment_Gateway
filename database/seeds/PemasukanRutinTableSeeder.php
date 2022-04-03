<?php

use Illuminate\Database\Seeder;

class PemasukanRutinTableSeeder extends Seeder
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
              'ibadah_id'  			=> 1,
              'kategori_id'  			=> 2,
              'kas_id'  			=> 1,
              'nama_pengguna'  			=> 1,
              'kode_pemasukan_rutin'  			=> 'TM122',
              'status'  			=> '1',
              'nominal'  			=> '1500000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'  			=> 2,
                'ibadah_id'  			=> 1,
                'kategori_id'  			=> 1,
                'kas_id'  			=> 1,
                'nama_pengguna'  			=> 1,
                'kode_pemasukan_rutin'  			=> 'TM122',
                'status'  			=> '1',
                'nominal'  			=> '500000',
                'tanggal'      => \Carbon\Carbon::now(),
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            
            [
              'id'  			=> 3,
              'ibadah_id'  			=> 1,
              'kategori_id'  			=> 1,
              'kas_id'  			=> 1,
              'nama_pengguna'  			=> 1,
              'kode_pemasukan_rutin'  			=> 'TM122',
              'status'  			=> '1',
              'nominal'  			=> '350000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],

            [
              'id'  			=> 4,
              'ibadah_id'  			=> 1,
              'kategori_id'  			=> 1,
              'kas_id'  			=> 2,
              'nama_pengguna'  			=> 1,
              'kode_pemasukan_rutin'  			=> 'TM122',
              'status'  			=> '1',
              'nominal'  			=> '500000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],

            [
              'id'  			=> 5,
              'ibadah_id'  			=> 1,
              'kategori_id'  			=> 1,
              'kas_id'  			=> 2,
              'nama_pengguna'  			=> 1,
              'kode_pemasukan_rutin'  			=> 'TM122',
              'status'  			=> '1',
              'nominal'  			=> '3500000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],

            [
              'id'  			=> 6,
              'ibadah_id'  			=> 1,
              'kategori_id'  			=> 2,
              'kas_id'  			=> 2,
              'nama_pengguna'  			=> 1,
              'kode_pemasukan_rutin'  			=> 'TM122',
              'status'  			=> '1',
              'nominal'  			=> '1500000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
              ]

        ]);
    }
}
