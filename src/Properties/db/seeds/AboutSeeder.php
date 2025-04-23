<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class AboutSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [];
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i <= 20; ++$i) {
            $date = $faker->unixTime('now');
            $data[] = [
                'title' => $faker->catchPhrase(),
                'description' => $faker->text(3000),
                'slug' => $faker->slug(),
                'created_at' => date('Y-m-d H:i:s', $date),
                'updated_at' => date('Y-m-d H:i:s', $date),
            ];
        }
        $this->table('about')
            ->insert($data)
            ->save();
        }
}
