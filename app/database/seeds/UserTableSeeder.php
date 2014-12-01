<?php

use Faker\Factory as Faker;
use Cartalyst\Sentry\Sentry;

class UserTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create('hr_HR');
        $sentry = new Sentry();

        // Create admin
        $sentry->getUserProvider()->create([
            'email'      => 'igor.gudelj@tvz.hr',
            'password'   => 'password',
            'activated'  => 1,
            'first_name' => 'Igor',
            'last_name'  => 'Gudelj',
            'address'    => 'Božidara Magovca 39',
            'phone'      => '0977670178',
            'place_id'   => 10000,
            'oib'        => $faker->randomNumber($nbDigits = 6) . $faker->randomNumber($nbDigits = 5),
        ]);

        // Assign user permissions
        $user  = $sentry->getUserProvider()->findByLogin('igor.gudelj@tvz.hr');
        $group = $sentry->getGroupProvider()->findByName('Administrator');
        $user->addGroup($group);

        // Create user
        $sentry->getUserProvider()->create([
            'email'      => 'user@tvz.hr',
            'password'   => 'password',
            'activated'  => 1,
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'address'    => 'Random Street 3',
            'phone'      => '0977670178',
            'place_id'   => 10000,
            'oib'        => $faker->randomNumber($nbDigits = 6) . $faker->randomNumber($nbDigits = 5),
        ]);

        // Assign user permissions
        $user  = $sentry->getUserProvider()->findByLogin('user@tvz.hr');
        $group = $sentry->getGroupProvider()->findByName('User');
        $user->addGroup($group);

        foreach(range(1, 50) as $index)
        {
            $email = $faker->email();
            $sentry->getUserProvider()->create([
                'email'      => $email,
                'password'   => 'password',
                'activated'  => 1,
                'first_name' => $faker->firstName(),
                'last_name'  => $faker->lastName(),
                'address'    => $faker->address(),
                'phone'      => $faker->phoneNumber(),
                'place_id'   => 10000,
                'oib'        => $faker->randomNumber($nbDigits = 6) . $faker->randomNumber($nbDigits = 5),
            ]);

            // Assign user permissions
            $user  = $sentry->getUserProvider()->findByLogin($email);
            $group = $sentry->getGroupProvider()->findByName('User');
            $user->addGroup($group);
        }
    }

}