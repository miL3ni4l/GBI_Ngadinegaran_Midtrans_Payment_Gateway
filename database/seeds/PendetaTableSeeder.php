<?php

use Illuminate\Database\Seeder;

class PendetaTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Pendeta::insert([
            [
              'id'  			=> 1,
              'nama_pendeta'  			=> 'Pdt. Marhinus Sumendi',
              'alias'		=> 'Marthinus',
              'tempat_lahir' 			=> 'Gunung Kidul',
              'tlp_pendeta'			=> '0878 7055 2929',
              'tgl_lahir'			=> 19-Mar-1968,
              'istri'			=> 'Srikembang',
              'pendidikan'			=> '-',
              'karir'			=> '-',
              'biografi'			=> '-',
              'cover' => '27019-2022-03-30-15-29-28.png',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}
