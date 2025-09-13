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
        //
        // Contact::factory()->count(35)->create();


        // try {
        //     logger()->info('Factory生成開始');

        //     $models = Contact::factory(12)->make();
        //     logger()->info('生成されたモデル数: ' . count($models));
        //     logger()->info('Factory生成完了、保存開始');

        //     foreach ($models as $index => $model) {
        //         try {
        //             logger()->info("保存試行: index={$index}, name={$model->name}");
        //             $model->save();
        //             logger()->info("保存成功: index={$index}, id={$model->id}");
        //         } catch (\Throwable $e) {
        //             logger()->error("保存失敗: index={$index}, error={$e->getMessage()}");
        //         }
        //     }

        //     logger()->info('保存処理完了');
        // } catch (\Throwable $e) {
        //     logger()->info("catchに入りました: {$e->getMessage()}");
        //     logger()->error("Factory失敗: {$e->getMessage()}");
        // }



        // for ($i = 0; $i < 35; $i++) {
        //     try {
        //         logger()->info("{$i}件目のFactory生成開始");

        //         $model = Contact::factory()->make();
        //         if ($i === 11) {
        //             dd($model->toArray()); // 12件目で止める
        //         }
        //         $model->save(); // create()ではなく save() に分離
        //         logger()->info("{$i}件目の保存完了");
        //         if ($i === 11) {
        //             dd($model->toArray()); // 12件目で止める
        //         }
        //     } catch (\Throwable $e) {
        //         logger()->info("{$i}件目のcatchに入りました: {$e->getMessage()}");
        //         logger()->error("{$i}件目のFactory失敗: {$e->getMessage()}");
        //         dd('例外発生: ' . $e->getMessage());
        //     }
        // }



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
