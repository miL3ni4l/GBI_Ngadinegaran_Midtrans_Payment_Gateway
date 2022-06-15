<?php

use Illuminate\Database\Seeder;

class PersembahanPengeluaranKhususTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\PersembahanPengeluaranKhusus::insert([
            [
              'id'  			=> 1,
              'kategori_id'  			=> 4,
              'nama_pengguna'  			=> 1,
              'kode_persembahan_pengeluaran_khusus'  			=> 'TK222',
              'status'  			=> '1',
              'nominal'  			=> '150000',
              'tanggal'      => \Carbon\Carbon::now(),
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}
