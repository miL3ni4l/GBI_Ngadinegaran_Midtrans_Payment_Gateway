<?php

use Illuminate\Database\Seeder;

class KomunitasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Komunitas::insert([
            [
              'id'  			=> 1,
              'nama_komunitas'  			=> 'Pemuda Remaja',
              'deskripsi'  			=> 'Kami adalah komunitas yang memakai tenaga kami yang tak terbatas untuk membangun hubungan pertemanan, menambah pengetahuan, dan melayani Tuhan dengan segala talenta kami.',
              'pj'  			=> 'Adit',
              'kontak'  			=> '082212344321',
              'status'  			=> '1',
              'cover'           => '91495-2022-04-22-03-45-12.jpg',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'  			=> 2,
                'nama_komunitas'  			=> 'Anak-anak',
                'deskripsi'  	    => 'Sebuah komunitas untuk anak-anak, lingkungan yang sehat dalam membentuk karakter anak-anak. ',
                'pj'  	    => 'Sara',
                'kontak'  	    => '085756788765',
                'status'  	    => '1',
                'cover'           => '59821-2022-04-22-03-46-03.jpg',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}
