<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class ContactSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [];
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 20; ++$i) {
            $date = $faker->unixTime('now');
            $data[] = [
                'created_at' => date('Y-m-d H:i:s', $date),
                'updated_at' => date('Y-m-d H:i:s', $date),
                'last_name' => $faker->lastName(),
                'first_name' => $faker->firstName(),
                'email' => $faker->email(),            
                'phone_number' => $faker->phoneNumber()
            ];
        }
        $this->table('contact')
            ->insert($data)
            ->save();
        }
}

