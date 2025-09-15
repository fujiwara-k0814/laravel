<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use Faker\Factory as Faker;


class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ja_JP');
        for ($i = 0; $i < 35; $i++) {
            try {
                Contact::create([
                    'category_id' => $faker->numberBetween(1, 5),
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'gender' => $faker->numberBetween(1, 3),
                    'email' => $faker->unique()->safeEmail,
                    'tel' => str_replace('-', '', $faker->phoneNumber),
                    'address' => $faker->prefecture() . $faker->city() . $faker->streetAddress(),
                    'building' => $faker->randomElement(['', $faker->secondaryAddress]),
                    'detail' => $faker->realText(120)
                ]);
            } catch (\Exception $e) {
                logger()->error("Seeder失敗: {$e->getMessage()}");
            }
        }
    }
}
