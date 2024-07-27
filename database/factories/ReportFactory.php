<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition()
    {
        return [
            'month' => $this->faker->numberBetween(1, 12),
            'year' => $this->faker->year,
            'text' => $this->faker->paragraph,
        ];
    }
}
