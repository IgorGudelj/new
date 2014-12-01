<?php

use Cartalyst\Sentry\Sentry;

class GroupsTableSeeder extends Seeder {

    public function run()
    {
        $sentry = new Sentry();

        $sentry->getGroupProvider()->create(array(
            'name'        => 'Administrator',
            'permissions' => array('admin' => 1, 'user' => 1),
        ));

        $sentry->getGroupProvider()->create(array(
            'name'        => 'User',
            'permissions' => array('admin' => 0, 'user' => 1),
        ));
    }

}