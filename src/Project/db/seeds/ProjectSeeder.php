<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class ProjectSeeder extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
            'CategorySeeder'
        ];
    }

    public function run(): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        $data = [];

        $categories = $this->fetchAll('SELECT id FROM categories');

        foreach ($categories as $category) {
            for ($i = 0; $i < 3; $i++) {
                $date = $faker->unixTime('now');

                // On a fait le lien avec la table category pour générer des données 'semi-aléatoires' 
                $data[] = [
                    'created_at' => date('Y-m-d H:i:s', $date),
                    'updated_at' => date('Y-m-d H:i:s', $date),
                    'published_at' => date('Y-m-d H:i:s', $date),
                    'picture' => $faker->imageUrl(200, 200, 'architecture', true, 'project'),
                    'title' => $faker->catchPhrase(),
                    'description' => $faker->text(3000),
                    'slug' => $faker->slug(),
                    'category_id' => $category['id']
                ];
            }
        }

        $this->table('project')
            ->insert($data)
            ->save();
    }
}
