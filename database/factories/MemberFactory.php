<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $start = Carbon::instance($this->faker->dateTimeBetween('-1 years', 'now'));
        $end = $start->copy()->addYear(); 
        

        return [
            'name' => $this->faker->name,
            'sex' => $this->faker->randomElement(['male', 'female']),
            'dob' => $this->faker->dateTimeBetween('-50 years', '-18 years'),
            'start' => $start,
            'end' => $end,
            'about_to_date' => 0,
            'contact' => $this->faker->unique()->email,
            'status' => $end < Carbon::now() ? "inactive" : 'active',
        ];
    }
}