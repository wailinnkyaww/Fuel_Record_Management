<?php

namespace Database\Factories;

use App\Models\FuelRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class FuelRecordFactory extends Factory
{
    protected $model = FuelRecord::class;

    public function definition(): array
    {
        $liter = fake()->numberBetween(10, 80);
        $pricePerLiter = fake()->randomElement([2500, 2800, 3100]);

        return [
            'region'       => fake()->city(),
            'plate_prefix' => (string) fake()->numberBetween(1, 9),
            'plate_letter' => strtoupper(fake()->lexify('?')), // စာလုံးတစ်လုံးတည်း အကြီးထွက်အောင်
            'plate_number' => fake()->numerify('####'),
            'oil_type'     => fake()->randomElement(['Diesel', '92 Octane', '95 Octane']),
            'liter'        => $liter,
            'total_price'  => $liter * $pricePerLiter,
            'times'        => 3,
        ];
    }
}
