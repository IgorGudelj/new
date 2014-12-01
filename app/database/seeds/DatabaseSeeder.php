<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->command->info('Seeding Places table!');
        $this->call('PlacesTableSeeder');

        $this->command->info('Seeding Groups table!');
        $this->call('GroupsTableSeeder');

        $this->command->info('Seeding Users table!');
        $this->call('UserTableSeeder');

        $this->command->info('Seeding Listings table!');
        $this->call('ListingsTableSeeder');
	}

}