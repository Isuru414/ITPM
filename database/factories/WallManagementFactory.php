<?php

$factory->define(App\WallManagement::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->date("Y-m-d", $max = 'now'),
        "title" => $faker->name,
        "description" => $faker->name,
    ];
});
