<?php

use Illuminate\Database\Seeder;

class DetailKategorisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\DetailKategori::insert([
            [
              'id'  			=> 1,
              'kode_kategori'  			=> '1',
              'kategori'  			=> 'Kolekte',
              'jenis'  			=> 'Rutin',
              'petugas_id'  			=> 1,
              'kategori_id'  			=> 1,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'  			=> 2,
              'kode_kategori'  			=> '1',
              'kategori'  			=> 'Persepuluhan',
              'jenis'  			=> 'Rutin',
              'petugas_id'  			=> 1,
              'kategori_id'  			=> 1,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
          //   [
          //     'id'  			=> 4,
          //   'kode_kategori'  			=> '2',
          //   'kategori'  			=> 'Janji Iman',
          //   'jenis'  			=> 'Rutin',
          //   'petugas_id'  			=> 2,
          //   'kategori_id'  			=> 1,
          //   'created_at'      => \Carbon\Carbon::now(),
          //   'updated_at'      => \Carbon\Carbon::now()
          // ],
            [
                'id'  			=> 3,
                'kode_kategori'  			=> '2',
                'kategori'  			=> 'Pembangunan',
                'jenis'  			=> 'Khusus',
                'petugas_id'  			=> 2,
                'kategori_id'  			=> 1,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 5,
              'kode_kategori'  			=> '2',
              'kategori'  			=> 'Dana Sound',
              'jenis'  			=> 'Khusus',
              'petugas_id'  			=> 2,
              'kategori_id'  			=> 1,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 4,
              'kode_kategori'  			=> '2',
              'kategori'  			=> 'Dana Multimedia',
              'jenis'  			=> 'Khusus',
              'petugas_id'  			=> 2,
              'kategori_id'  			=> 1,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}
