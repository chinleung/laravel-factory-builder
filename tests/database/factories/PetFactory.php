<?php

use ChinLeung\Factories\Tests\Models\Pet;
use ChinLeung\Factories\Tests\Models\User;
use Faker\Generator as Faker;

$factory->define(Pet::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'user_id' => factory(User::class),
    ];
});
