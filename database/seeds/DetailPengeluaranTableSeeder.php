<?php

use Illuminate\Database\Seeder;

class DetailPengeluaranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\DetailPengeluaran::insert([
            [
              'id'  			=> 1,
              'kategori'  			=> 'Gaji Pendeta',
              'petugas_id'  			=> 1,
              'kategori_id'  			=> 1,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],

            [
                'id'  			=> 2,
              'kategori'  			=> 'Gaji Karyawan',
              'petugas_id'  			=> 1,
              'kategori_id'  			=> 1,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],

            [
                'id'  			=> 3,
                'kategori'  			=> 'Divisi Ibadah',
                'petugas_id'  			=> 1,
                'kategori_id'  			=> 2,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 4,
              'kategori'  			=> 'Divisi Gembala',
              'petugas_id'  			=> 1,
              'kategori_id'  			=> 2,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
          ],

            [
              'id'  			=> 5,
              'kategori'  			=> 'Air',
              'petugas_id'  			=> 1,
              'kategori_id'  			=> 6,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 6,
              'kategori'  			=> 'Listrik',
              'petugas_id'  			=> 1,
              'kategori_id'  			=> 6,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 7,
              'kategori'  			=> 'Internet WI-FI',
              'petugas_id'  			=> 1,
              'kategori_id'  			=> 6,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 8,
              'kategori'  			=> '1 Kertas HVS Folio 80gram ',
              'petugas_id'  			=> 1,
              'kategori_id'  			=> 3,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 9,
              'kategori'  			=> 'Amplop Polos',
              'petugas_id'  			=> 1,
              'kategori_id'  			=> 3,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 10,
              'kategori'  			=> 'Puplen  ',
              'petugas_id'  			=> 1,
              'kategori_id'  			=> 3,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 11,
              'kategori'  			=> 'Konsumsi Ibadah Rabu',
              'petugas_id'  			=> 1,
              'kategori_id'  			=> 5,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 12,
              'kategori'  			=> 'Konsumsi Ibadah Minggu',
              'petugas_id'  			=> 1,
              'kategori_id'  			=> 5,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ]
            
        ]);
    }
}
