<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class BlogSeeder extends AbstractSeed
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
                'title' => $faker->catchPhrase(),            
                'description' => $faker->text(3000),
                'slug' => $faker->slug(),
                'username'=>$faker->userName(),
            ];
        }
        $this->table('blog')
            ->insert($data)
            ->save();
        }
}