<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'id' => (string) Str::orderedUuid(),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'age' => rand(20, 45),
        'attribute' => rand(0, 1),
        'tel' => $faker->phoneNumber,
        'email' => $faker->email,
        'comment' => $faker->realText(),
        'password' => Hash::make($faker->password()),
        'family_id' => Str::orderedUuid(),
        'remember_token' => Str::random(10),
    ];
});
