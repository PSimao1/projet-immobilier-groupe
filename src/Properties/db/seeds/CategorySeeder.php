<?php
// Catégories principales: Locations, Ventes et AirBNB
declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class CategorySeeder extends AbstractSeed
{
    public function run(): void
    {
        $category = [
            1 => [
                'name' => 'vente',
                'slug' => 'bien_a_vendre',
                'picture' => '01.jpg',
                'is_online' => '1'
            ],
            2 => [
                'name' => 'location',
                'slug' => 'bien_a_louer',
                'picture' => '02.jpg',
                'is_online' => '1' 
            ],
            3 => [
                'name' => 'airbnb',
                'slug' => 'location_courte_duree',
                'picture' => '03.jpg',
                'is_online' => '1'
            ]
        ];
        
        $faker  = \Faker\Factory::create('fr_FR');
        $data = [];
        $date = $faker->unixTime('now');
        
        $item = $this->fetchAll('SELECT id FROM users');

        foreach($category as $key => $cat)
        {
            $getItem = array_rand($item);
            $userItem = $item[$getItem]['id'];

            $data[] = [
                'name' => $cat['name'],
                'slug' => $cat['slug'],
                'picture' => $cat['picture'],
                'is_online' => $cat['is_online'],
                'created_at' => date('Y-m-d H:i:s', $date),
                'updated_at' => date('Y-m-d H:i:s', $date),
                'user_id' => $userItem
            ];
        }
        $this->table('categories')
            ->insert($data)
            ->save();
    }
}