<?php

namespace Database\Factories;

use App\Models\ReportPhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportPhotoFactory extends Factory
{
    protected $model = ReportPhoto::class;

    public function definition()
    {
        return [
            'photo' => $this->faker->imageUrl,
            'html_link' => '<img src="' . $this->faker->imageUrl . '">',
        ];
    }
}

