<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class FaqSeeder extends AbstractSeed
{

    public function run(): void
    {
        $data = [];
        $faker  = \Faker\Factory::create('fr_FR');
        $date = $faker->unixTime('now');
        for ( $i=0; $i < 10; ++$i) {
            $data[] = [
                'created_at' => date('Y-m-d H:i:s', $date),
                'updated_at' => date('Y-m-d H:i:s', $date),
                'request' => $faker->text(),
                'response' => $faker->paragraph(2, true),
            ];
        }
        
        $this->table('faq')
            ->insert($data)
            ->save();
    }
}
