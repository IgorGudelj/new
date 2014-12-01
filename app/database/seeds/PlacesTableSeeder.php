<?php

class PlacesTableSeeder extends Seeder {

    public function run()
    {
        Place::create([
            'id'            =>  10000,
            'slug'          =>  'zagreb',
            'name'          =>  'Zagreb',
            'geo_x'           =>  '45.797451',
            'geo_y'           =>  '15.979244',
        ]);

        Place::create([
            'id'            =>  10290,
            'slug'          =>  'zapresic',
            'name'          =>  'Zaprešić',
        ]);

        Place::create([
            'id'            =>  10360,
            'slug'          =>  'sesvete',
            'name'          =>  'Sesvete',
        ]);

        Place::create([
            'id'            =>  10410,
            'slug'          =>  'velika.gorica',
            'name'          =>  'Velika Gorica',
        ]);

        Place::create([
            'id'            =>  10430,
            'slug'          =>  'samobor',
            'name'          =>  'Samobor',
        ]);
    }

}