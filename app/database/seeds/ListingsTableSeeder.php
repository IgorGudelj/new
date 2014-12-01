<?php

use Faker\Factory as Faker;

class ListingsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 10) as $index)
        {
            foreach(range(1, 3) as $user)
            {
                $listing = Listing::create([
                    'user_id' => $index,
                    'title' => $faker->sentence($nbWords = 6),
                    'address' => $faker->streetAddress,
                    'place_id' => 10000,
                    'geo_x' => $faker->randomFloat($nbMaxDecimals = 6, $min = 45.7, $max = 45.9),
                    'geo_y' => $faker->randomFloat($nbMaxDecimals = 6, $min = 15.9, $max = 16.1),
                    'description' => $faker->paragraph($nbSentences = 25),
                    'website' => 'http://' . $faker->domainName,
                ]);

                foreach(range(1, 2) as $images)
                {
                    $image = new Image();
                    $image->filename = $faker->imageUrl(700, 523, 'nature');
                    $image->listing()->associate($listing);
                    $image->save();
                }

                $image = new Image();
                $image->filename = $faker->imageUrl(700, 523, 'city');
                $image->listing()->associate($listing);
                $image->save();

            }

        }
    }

}