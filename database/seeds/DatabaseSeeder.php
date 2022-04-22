<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PetugassTableSeeder::class);  

        $this->call(KassTableSeeder::class);
        $this->call(IbadahsTableSeeder::class);

        $this->call(KategorisTableSeeder::class);
        $this->call(KategoriPengeluaranRutinTableSeeder::class);   
      
        $this->call(DetailKategorisTableSeeder::class);
        $this->call(DetailPengeluaranTableSeeder::class);
      
        //RUTIN
        $this->call(PemasukanRutinTableSeeder::class); 
        $this->call(PengeluaranRutinTableSeeder::class); 

        // KHUSUS
        $this->call(PemasukanKhususTableSeeder::class); 
        $this->call(PengeluaranKhususTableSeeder::class);
        
        // UTAMA
        $this->call(ProfilTableSeeder::class);  
        $this->call(PendetaTableSeeder::class);  
        $this->call(KomunitasTableSeeder::class);  
    }
}
