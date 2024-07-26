<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenderProposalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tender_proposals')->insert([
            [
                'company_name' => 'Компанія A',
                'legal_address' => 'Вулиця 1, Київ',
                'contact_person_name' => 'Іван Іванов',
                'contact_person_phone' => '+380123456789',
            ],
            [
                'company_name' => 'ФОП B',
                'legal_address' => 'Вулиця 2, Львів',
                'contact_person_name' => 'Оксана Петрів',
                'contact_person_phone' => '+380987654321',
            ],
        ]);
    }
}

