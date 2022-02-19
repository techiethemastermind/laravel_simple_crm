<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'    => $this->faker->name(),
            'email'   => $this->faker->unique()->safeEmail(),
            'phone'   => '+1' . $this->faker->numerify('##########'),
            'budget'  => $this->faker->numberBetween(1, 50),
            'wp_account' => 0,
            'message' => Str::random(50),
        ];
    }
}
