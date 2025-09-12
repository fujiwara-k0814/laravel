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
        $faker = \Faker\Factory::create('ja_JP');
        
        return [
            //
            'category_id' => $faker->numberBetween(1, 5),
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'gender' => $faker->numberBetween(1, 3),
            'email' => $faker->safeEmail,
            'tel' => $faker->phoneNumber,
            'address' => $faker->prefecture() . $faker->city() . $faker->streetAddress(),
            'building' => $faker->secondaryAddress,
            'detail' => $faker->realText(120)
        ];
    }
}
