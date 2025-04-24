<?php

use Phinx\Seed\AbstractSeed;

class CartSeeder extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
            'AccountSeeder',
            'PropertiesSeeder'
        ];
    }

    public function run(): void
    {
        $carts = [];
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i <= 20; ++$i) {
            $date = $faker->unixTime('now');
            $carts[] = [
                'created_at' => date('Y-m-d H:i:s', $date),
                'updated_at' => date('Y-m-d H:i:s', $date),           
                'slug' => $faker->slug(),
                'total_price' => $faker->randomFloat(2, 0, 100),
                'arrival_date' => $faker->date('Y-m-d H:i:s', $date),
                'departure_date' => $faker->date('Y-m-d H:i:s', $date),
                'payment_method' => $faker->creditCardType(),
                'located_property' => rand(1,100),
                'unique_payment_id' => $faker->randomFloat(0, 0, 100),
                'status' => $faker->randomElement(['En Cours', 'Remboursé', 'Annulé', 'Livré'])
            ];
        }

        $faker  = \Faker\Factory::create('fr_FR');
        $data = [];
        $date = $faker->unixTime('now');

        $uItem = $this->fetchAll('SELECT id FROM users');
        $pItem = $this->fetchAll('SELECT id FROM properties');

        foreach($carts as $key => $cart)
        {
            $getUser = array_rand($uItem);
            $userItem= $uItem[$getUser]['id'];

            $getProp = array_rand($pItem);
            $PropItem= $pItem[$getProp]['id'];

            $data[] = [
                'created_at' => date('Y-m-d H:i:s', $date),
                'updated_at' => date('Y-m-d H:i:s', $date),
                'slug' => $cart['slug'],
                'total_price' => $cart['randomFloat'],
                'arrival_date' => date('Y-m-d H:i:s', $date),
                'departure_date' => date('Y-m-d H:i:s', $date),
                'payment_method' => $cart['creditCardType'],
                'located_property' =>rand(1, 100),
                'unique_payment_id' => $cart['randomFloat'],
                'status' => $cart['randomElement'],
                'user_id' => $userItem,
                'property_id' => $PropItem
            ];
        }

        $this->table('cart')
            ->insert($cart)
            ->save();
        }
}
