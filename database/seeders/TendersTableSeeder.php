<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tenders')->insert([
            [
                'publication_date' => Carbon::now()->subDays(10),
                'submission_deadline' => Carbon::now()->addDays(10),
                'delivery_date_range_start' => Carbon::now()->addDays(15),
                'delivery_date_range_end' => Carbon::now()->addDays(30),
                'product_service_name' => 'Товари A',
                'quantity' => 100,
                'delivery_address' => 'Вулиця 1, Київ',
            ],
            [
                'publication_date' => Carbon::now()->subDays(5),
                'submission_deadline' => Carbon::now()->addDays(5),
                'delivery_date_range_start' => Carbon::now()->addDays(10),
                'delivery_date_range_end' => Carbon::now()->addDays(20),
                'product_service_name' => 'Послуги B',
                'quantity' => 50,
                'delivery_address' => 'Вулиця 2, Львів',
            ],
        ]);
    }
}

