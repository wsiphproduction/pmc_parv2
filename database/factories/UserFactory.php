<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\UserDetails::class, function (Faker $faker) {
    return [
        'fullName' => $faker->name,
        'domainAccount' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'role' => 'admin',
        'dept' => 'Information Communications Technology',
        'isActive' => 1,
        'isLocked' => 0,
        'addedBy' => 'default',
        'lockedOn' => ''
    ];
});
?>