<?php

$factory->define(App\DigitalLibrary::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "date" => $faker->date("Y-m-d", $max = 'now'),
    ];
});
