<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rewards')->insert([
            'customer_id' => 1,
            'phone' => '9550184196',
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-01-05 16:37:03',
        ]);

        DB::table('rewards')->insert([
            'customer_id' => 2,
            'phone' => '8688079590',
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-01-05 16:37:03',
        ]);

        DB::table('rewards')->insert([
            'customer_id' => 3,
            'phone' => '8247354466',
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-01 16:37:03',
        ]);

        DB::table('rewards')->insert([
            'customer_id' => 1,
            'phone' => '9550184196',
            'redeem' => 10,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-01 16:37:03',
        ]);

        DB::table('rewards')->insert([
            'customer_id' => 1,
            'phone' => '9550184196',
            'redeem' => 30,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-03 16:37:03',
        ]);

        DB::table('rewards')->insert([
            'customer_id' => 1,
            'phone' => '9550184196',
            'redeem' => 25,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-04 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 1,
            'phone' => '9550184196',
            'credits' => 500,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-04 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 1,
            'phone' => '9550184196',
            'redeem' => 150,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-05 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 1,
            'phone' => '9550184196',
            'credits' => 200,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-05 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 1,
            'phone' => '9550184196',
            'redeem' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);

        DB::table('rewards')->insert([
            'customer_id' => 3,
            'phone' => '1234567891',
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 4,
            'phone' => '1234567892',
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 5,
            'phone' => '1234567893',
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 6,
            'phone' => '1234567894',
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 7,
            'phone' => '1234567895',
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 8,
            'phone' => '1234567896',
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 9,
            'phone' => '1234567897',
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 10,
            'phone' => '1234567898',
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 11,
            'phone' => '1234567899',
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 12,
            'phone' => '1234567890',
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
    }
}
