<?php

use Illuminate\Database\Seeder;

class PetugassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Petugas::insert([
            [
              'id'  			=> 1,
              'nama'  			=> 'Joshua Jo',
              'jk'  			=> 'L',
              'kode_petugas' 	=> 'NIP-0001',
              'user_id'			=> 1,
              'alamat' 	        => 'Jalan Bantul',
              'no_telp' 	        => '085500001234',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 2,
              'nama'  			=> 'Dita',
              'jk'  			=> 'P',
              'kode_petugas' 	=> 'NIP-0002',
              'user_id'			=> 3,
              'alamat' 	        => 'Jalan Imogiri',
              'no_telp' 	        => NULL,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}
