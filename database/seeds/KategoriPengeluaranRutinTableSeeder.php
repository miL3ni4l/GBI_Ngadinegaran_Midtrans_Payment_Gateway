
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
                'kategori'  	    => 'ATK',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'  			=> 3,
                'kode_kategori'  			=> 'KK03',
                'kategori'  	    => 'Opersional',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ]
        
        ]);
    }
}
