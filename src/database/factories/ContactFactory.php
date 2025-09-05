<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'category_id' => $this->faker->numberBetween(1, 5),
            'first_name'  => $this->faker->firstName(),
            'last_name'   => $this->faker->lastName(),
            'gender'      => $this->faker->numberBetween(1, 3),
            'email'       => $this->faker->unique()->safeEmail(),
            'tel'         => $this->faker->phoneNumber(),
            'adress'      => $this->faker->address(),
            'building'    => $this->faker->secondaryAddress(),
            'detail'      => $this->faker->paragraph(),
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}
