<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('ja_JP');

        $categories = DB::table('categories')->pluck('id')->toArray();

        for ($i = 0; $i < 35; $i++) {
            DB::table('contacts')->insert([
                'category_id' => $categories[array_rand($categories)],
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'gender' => $faker->numberBetween(0, 2),
                'email' => $faker->email,
                'tell' => $faker->phoneNumber,
                'address' => $faker->address,
                'building' => $faker->buildingNumber,
                'detail' => $faker->realText(200),
            ]);
        }
    }
}
