<?php

use Illuminate\Database\Seeder;

class PengeluaranRutinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\PengeluaranRutin::insert([
            [
              'id'  			=> 1,
              'kategori_id'  			=> 2,
              'detail_pengeluaran'  			=> 1,
              'kas_id'  			=> 1,
              'nama_pengguna'  			=> 1,
              'kode_pengeluaran_rutin'  			=> 'TK122',
              'status'  			=> '1',
              'nominal'  			=> '150000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'  			=> 2,
                'kategori_id'  			=> 2,
                'detail_pengeluaran'  			=> 2,
                'kas_id'  			=> 1,
                'nama_pengguna'  			=> 1,
                'kode_pengeluaran_rutin'  			=> 'TK122',
                'status'  			=> '1',
                'nominal'  			=> '350000',
                'tanggal'      => \Carbon\Carbon::now(),
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            
            [
              'id'  			=> 3,
              'kategori_id'  			=> 1,
              'detail_pengeluaran'  			=> 4,
              'kas_id'  			=> 1,
              'nama_pengguna'  			=> 1,
              'kode_pengeluaran_rutin'  			=> 'TK122',
              'status'  			=> '1',
              'nominal'  			=> '250000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 4,
              'kategori_id'  			=> 1,
              'detail_pengeluaran'  			=> 3,
              'kas_id'  			=> 1,
              'nama_pengguna'  			=> 1,
              'kode_pengeluaran_rutin'  			=> 'TK122',
              'status'  			=> '1',
              'nominal'  			=> '250000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 5,
              'kategori_id'  			=> 1,
              'detail_pengeluaran'  			=> 4,
              'kas_id'  			=> 1,
              'nama_pengguna'  			=> 1,
              'kode_pengeluaran_rutin'  			=> 'TK122',
              'status'  			=> '1',
              'nominal'  			=> '500000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
              ]
        ]);
    }
}
