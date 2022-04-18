<?php

use Illuminate\Database\Seeder;

class IbadahsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Ibadah::insert([
            [
              'id'  			=> 1,
              'kode_ibadah'  			=> 'I01',
              'ibadah'  			=> 'Ibadah Minggu',
              'jam'  			=> '07:00',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'  			=> 2,
                'kode_ibadah'  			=> 'I02',
                'ibadah'  	    => 'Ibadah Doa Rabu',
                'jam'  			=> '18:00',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'  			=> 3,
                'kode_ibadah'  			=> 'I03',
                'ibadah'  	    => 'Ibadah PKRB & PKMB',
                'jam'  			=> '18:30',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'  			=> 4,
                'kode_ibadah'  			=> 'I04',
                'ibadah'  	    => 'Sekolah Minggu',
                'jam'  			=> '08:00',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}
