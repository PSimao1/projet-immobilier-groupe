<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class PropertiesSeeder extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
            'AccountSeeder',
            'CategorySeeder'
        ];
    }

    public function run(): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        $data = [];

        $users = $this->fetchAll('SELECT id FROM users');
        $categories = $this->fetchAll('SELECT id FROM categories');
        $date = $faker->unixTime('now');

        $propertyTypes = [
            'Maison',
            'Appartement',
            'Studio',
            'Villa',
            'Château'
        ];

        foreach ($propertyTypes as $type) {
            for ($i = 0; $i < 10; $i++) {
                $userId = $users[array_rand($users)]['id'];
                $categoryId = $categories[array_rand($categories)]['id'];

                $data[] = [
                    'title' => $type . ' ' . $faker->sentence(3),
                    'slug' => $faker->slug(),
                    'description' => $faker->paragraph(10),
                    'price' => rand(1, 10),
                    'area' => rand(1, 10),
                    'rooms' => rand(1, 10),
                    'carrez' => rand(1, 10),
                    'prefix_area' => $faker->randomElement(['m²', 'ft²']),
                    'land_area' => rand(1, 10),
                    'bedrooms' => rand(1, 5),
                    'bathrooms' => rand(1, 3),
                    'garages' => rand(0, 2),
                    'construction_year' => $faker->year(),
                    'ac' => $faker->boolean(),
                    'swimming_pool' => $faker->boolean(),
                    'lawn' => $faker->boolean(),
                    'barbecue' => $faker->boolean(),
                    'microwave' => $faker->boolean(),
                    'television' => $faker->boolean(),
                    'dryer' => $faker->boolean(),
                    'outdoor_shower' => $faker->boolean(),
                    'washer' => $faker->boolean(),
                    'gym' => $faker->boolean(),
                    'fridge' => $faker->boolean(),
                    'wifi' => $faker->boolean(),
                    'laundry' => $faker->boolean(),
                    'sauna' => $faker->boolean(),
                    'windows_curtains' => $faker->boolean(),
                    'adress' => $faker->streetAddress(),
                    'zip_code' => $faker->postcode(),
                    'city' => $faker->city(),
                    'country' => $faker->country(),
                    'longitude' => $faker->longitude(),
                    'latitude' => $faker->latitude(),
                    'created_at' => date('Y-m-d H:i:s', $date),
                    'updated_at' => date('Y-m-d H:i:s', $date),
                    'user_id' => $userId,
                    'category_id' => $categoryId,
                ];
            }
        }

        $this->table('properties')
        ->insert($data)
        ->save();
    }
}