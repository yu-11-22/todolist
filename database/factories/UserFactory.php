<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

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

$factory->define(App\Model\User::class, function (Faker $faker) {
    return [
        'account' => $faker->userName,
        // 'email' => $faker->unique()->email,
        'password' => bcrypt('123456'),
        // 'remember_token' => str_random(10),
    ];
});
