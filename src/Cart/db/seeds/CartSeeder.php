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
        $faker = Faker\Factory::create('fr_FR');
        $carts = [];

        for ($i = 0; $i <= 20; ++$i) {
            $date = $faker->unixTime('now');
            $carts[] = [
                'created_at' => date('Y-m-d H:i:s', $date),
                'updated_at' => date('Y-m-d H:i:s', $date),           
                'total_price' => $faker->randomFloat(2, 0, 100),
                'payment_method' => $faker->creditCardType(),
                'unique_payment_id' => $faker->randomFloat(0, 0, 100),
            ];
        }

        $uItem = $this->fetchAll('SELECT id FROM users');
        $pItem = $this->fetchAll('SELECT id FROM properties');
        $data = [];

        foreach ($carts as $cart) {
            $getUser = array_rand($uItem);
            $userItem = $uItem[$getUser]['id'];

            $getProp = array_rand($pItem);
            $propItem = $pItem[$getProp]['id'];

            $data[] = [
                'created_at' => $cart['created_at'],
                'updated_at' => $cart['updated_at'],
                'total_price' => $cart['total_price'],
                'payment_method' => $cart['payment_method'],
                'unique_payment_id' => $cart['unique_payment_id'],
                'user_id' => $userItem,
                'property_id' => $propItem,
            ];
        }

        $this->table('cart')
            ->insert($data)
            ->save();
    }
}