<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$factory->define(App\User::class, function ($faker) {

    return [
        'name' => 'Tieungao',
        'email' => 'tieumaster@yahoo.com',
        'password' => bcrypt('232323'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Delivery::class, function ($faker) {

    return [
        'city' => $faker->city,
        'title' => $faker->name,
        'address' => $faker->wardName,
        'phone' => $faker->phoneNumber,
        'area' => $faker->randomElement(array('Miền Bắc', 'Miền Trung', 'Miền Nam'))
    ];
});
