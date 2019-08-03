<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Task::class, function (Faker $faker) {
    return [
        'content' => $faker->text,
        'start_date' => $faker->dateTime->getTimestamp(),
        'end_date' => $faker->dateTime->getTimestamp(),
    ];
});
