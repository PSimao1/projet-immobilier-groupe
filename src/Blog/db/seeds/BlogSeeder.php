<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class BlogSeeder extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
            'AccountSeeder'
        ];
    }

    public function run(): void
    {
        $blogs = [];
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i <= 20; ++$i) {
            $date = $faker->unixTime('now');
            $blogs[] = [
                'created_at' => date('Y-m-d H:i:s', $date),
                'updated_at' => date('Y-m-d H:i:s', $date),
                'title' => $faker->catchPhrase(),            
                'description' => $faker->text(3000),
                'slug' => $faker->slug(),
            ];
        }

        $data = [];
        $date = $faker->unixTime('now');

        $item = $this->fetchAll('SELECT id FROM users');

        foreach($blogs as $key => $blog)
        {
            $getItem = array_rand($item);
            $userItem = $item[$getItem]['id'];

            $data[] = [
                'title' => $blog['title'],
                'slug' => $blog['slug'],
                'description' => $blog['description'],
                'created_at' => date('Y-m-d H:i:s', $date),
                'updated_at' => date('Y-m-d H:i:s', $date),
                'role' => json_encode($faker->randomElement(['admin', 'user', 'moderateur'])),
                'picture' => $faker->imageUrl(270, 406, 'animals', true),
                'user_id' => $userItem
            ];
        }

        $this->table('blog')
            ->insert($data)
            ->save();
        }
}