<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Family;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Family::class, function (Faker $faker) {
    return [
        'id' => Str::orderedUuid(),
    ];
});
