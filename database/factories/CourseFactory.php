<?php

$factory->define(App\Course::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "description" => $faker->name,
        "published" => 0,
    ];
});
