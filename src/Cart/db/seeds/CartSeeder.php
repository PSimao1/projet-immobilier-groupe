<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class CartSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [];
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i <= 100; ++$i) {
            $date = $faker->unixTime('now');
            $data[] = [
                'created_at' => date('Y-m-d H:i:s', $date),
                'updated_at' => date('Y-m-d H:i:s', $date),           
                'slug' => $faker->slug(),
                'total_price' => $faker->randomFloat(2, 0, 100),
                'arrival_date' => $faker->date('Y-m-d H:i:s', $date),
                'departure_date' => $faker->date('Y-m-d H:i:s', $date),
                'payment_method' => $faker->creditCardType(),
                'username' => $faker->userName(),
                'located_property' => $faker->randomFloat(0, 0, 100),
                'unique_payment_id' => $faker->randomFloat(0, 0, 100),
                'status' => $faker->randomElement(['En Cours', 'Remboursé', 'Annulé', 'Livré'])
            ];
        }
        $this->table('cart')
            ->insert($data)
            ->save();
        }
}
