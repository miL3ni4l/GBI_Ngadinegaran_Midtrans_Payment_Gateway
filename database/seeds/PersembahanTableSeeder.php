<?php

use Illuminate\Database\Seeder;

class PersembahanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Donation::insert([
            [
                'id'              => 1,
                'transaction_id'              => 'c59b5c0e-b47f-431d-81fc-9dcf778db1f9',
                'donor_name'              => 'Angga Kaharap',
                'donor_email'              => 'anggadeka.id@gmail.com',
                'donation_type'              => 1,
                'status'              => 'success',
                'amount'              => '150000',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'              => 2,
                'transaction_id'              => 'sdacssss-b47f-431d-81fc-2642364sk00',
                'donor_name'              => 'Santika',
                'donor_email'              => 'anggadeka.id@gmail.com',
                'donation_type'              => 2,
                'status'              => 'success',
                'amount'              => '350000',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'              => 3,
                'transaction_id'              => 'ddgfg333-b47f-431d-81fc-2642364sk00',
                'donor_name'              => 'Jonang',
                'donor_email'              => 'anggadeka.id@gmail.com',
                'donation_type'              => 2,
                'status'              => 'success',
                'amount'              => '500000',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'              => 4,
                'transaction_id'              => '54sssfs-b47f-431d-81fc-2642364sk00',
                'donor_name'              => 'Joshua',
                'donor_email'              => 'anggadeka.id@gmail.com',
                'donation_type'              => 4,
                'status'              => 'success',
                'amount'              => '1000000',
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}
