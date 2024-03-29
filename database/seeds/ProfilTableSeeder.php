<?php

use Illuminate\Database\Seeder;

class ProfilTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Profil::insert([
            [
              'id'  			=> 1,
              'nama_gereja'  			=> 'GBI NGADINEGARAN',
              'alamat_gereja'		=> 'Jl. DI Panjaitan No.29, Mantrijeron, Kec. Mantrijeron, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55143',
              'email_gereja' 			=> 'gbingadinegaran@gmail.com',
              'tlp_gereja'			=> '0878 7055 2929',
              'sejarah_gereja'			=> 'Panjang',
              'visi_gereja'			=> 'MELATY Melaksanakan Amanat Agung Tuhan Yesus Kristus (Matius 28:18-20).',
              'misi_gereja'			=> 'Mencerdaskan Kehidupan Bangsa ',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}
