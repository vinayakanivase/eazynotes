<?php

use Faker\Generator as Faker;
use DavidBadura\FakerMarkdownGenerator\FakerProvider;

$factory->define(App\Note::class, function (Faker $faker) {
    $faker->addProvider(new FakerProvider($faker));

    return [
        'title' => $faker->words(3, true),
        'body' => $faker->markdown(),
        'favorite' => $faker->randomElement([false, true]),
        'user_id' => mt_rand(1, 20),
    ];
});
