<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Task;
use \App\Models\User;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2),
        'description' => $faker->realText(),
        'completed_at' => null,
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
