<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offer;
use App\Models\OfferTimePeriod;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offer1 = Offer::create([
            'title' => 'Volunteer for Food Distribution',
            'image' => 'offers/food_distribution.jpg',
            'description' => 'Help distribute food to the needy.',
            'vacancies_number' => 5,
            'is_active' => true,
        ]);

        OfferTimePeriod::create([
            'offer_id' => $offer1->id,
            'start_date' => '2024-08-01',
            'end_date' => '2024-08-05',
            'start_time' => '12:00:00',
            'end_time' => '15:00:00',
        ]);

        $offer2 = Offer::create([
            'title' => 'Medical Assistance',
            'image' => 'offers/medical_assistance.jpg',
            'description' => 'Provide medical assistance to the elderly.',
            'vacancies_number' => 3,
            'is_active' => true,
        ]);

        OfferTimePeriod::create([
            'offer_id' => $offer2->id,
            'start_date' => '2024-08-10',
            'end_date' => '2024-08-15',
            'start_time' => '09:00:00',
            'end_time' => '12:00:00',
        ]);

        $offer3 = Offer::create([
            'title' => 'Educational Support',
            'image' => 'offers/educational_support.jpg',
            'description' => 'Support children with their studies.',
            'vacancies_number' => 4,
            'is_active' => true,
        ]);

        OfferTimePeriod::create([
            'offer_id' => $offer3->id,
            'start_date' => '2024-08-20',
            'end_date' => '2024-08-25',
            'start_time' => '14:00:00',
            'end_time' => '17:00:00',
        ]);
    }
}
