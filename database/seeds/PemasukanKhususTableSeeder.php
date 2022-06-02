<?php

use Illuminate\Database\Seeder;

class PemasukanKhususTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\PemasukanKhusus::insert([
          

            [
                'id'  			=> 1,
                'ibadah_id'  			=> 1,
                'kategori_id'  			=> 3,
                'kas_id'  			=> 1,
                'nama_pengguna'  			=> 1,
                'kode_pemasukan_khusus'  			=> 'TM222',
                'status'  			=> '1',
                'nominal'  			=> '500000',
                'tanggal'      => \Carbon\Carbon::now(),
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            
            [
              'id'  			=> 2,
              'ibadah_id'  			=> 1,
              'kategori_id'  			=> 3,
              'kas_id'  			=> 1,
              'nama_pengguna'  			=> 1,
              'kode_pemasukan_khusus'  			=> 'TM222',
              'status'  			=> '1',
              'nominal'  			=> '1500000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],

            [
              'id'  			=> 3,
              'ibadah_id'  			=> 1,
              'kategori_id'  			=> 3,
              'kas_id'  			=> 2,
              'nama_pengguna'  			=> 1,
              'kode_pemasukan_khusus'  			=> 'TM222',
              'status'  			=> '1',
              'nominal'  			=> '2500000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],

            [
              'id'  			=> 4,
              'ibadah_id'  			=> 1,
              'kategori_id'  			=> 3,
              'kas_id'  			=> 2,
              'nama_pengguna'  			=> 1,
              'kode_pemasukan_khusus'  			=> 'TM222',
              'status'  			=> '1',
              'nominal'  			=> '2500000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
              ]

        ]);
    }
}
