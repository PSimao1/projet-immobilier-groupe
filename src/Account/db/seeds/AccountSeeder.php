<?php


use Phinx\Seed\AbstractSeed;

class AccountSeeder extends AbstractSeed
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
                'phone_number' => $faker->phoneNumber(),
                'password' => $faker->password(),
                'address' => $faker->address(),
                'role' => $faker->randomElement(['admin', 'user', 'moderateur']),
                'is_valid' => $faker->boolean(),
                'last_login' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                'picture' => $faker->imageUrl(200, 200, 'people')
            ];
        }
        $this->table('Account')
            ->insert($data)
            ->save();
        }
    
}
