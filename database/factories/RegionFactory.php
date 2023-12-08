<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Region>
 */
class RegionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->randomElement(['Dakar', 'Diourbel', 'Fatick', 'Kaolack', 'Kolda', 'Saint-Louis', 'Kaffrine', 'Tambacounda', 'Matam', 'Ziguinchor', 'Kédougou', 'Thiès', 'Sédhiou', 'Louga'])
        ];
    }
    
}
