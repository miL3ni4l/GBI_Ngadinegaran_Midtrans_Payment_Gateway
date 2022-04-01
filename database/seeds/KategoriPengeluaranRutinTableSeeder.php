
<?php

use Illuminate\Database\Seeder;

class KategoriPengeluaranRutinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\KategoriPengeluaranRutin::insert([
            [
              'id'  			=> 1,
              'kode_kategori'  			=> 'KK01',
              'kategori'  			=> 'Gaji',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'  			=> 2,
                'kode_kategori'  			=> 'KK02',
                'kategori'  	    => 'Program Kerja',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'  			=> 3,
                'kode_kategori'  			=> 'KK03',
                'kategori'  	    => 'ATK',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            // [
            //     'id'  			=> 4,
            //     'kode_kategori'  			=> 'KK06',
            //     'kategori'  	    => 'Transpotasi',
            //     'created_at'      => \Carbon\Carbon::now(),
            //     'updated_at'      => \Carbon\Carbon::now()
            // ],
            [
                'id'  			=> 5,
                'kode_kategori'  			=> 'KK04',
                'kategori'  	    => 'Konsumsi',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ], 
            [
                'id'  			=> 6,
                'kode_kategori'  			=> 'KK05',
                'kategori'  	    => 'Opersional',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ]
        
        ]);
    }
}
