<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(5, true),
        'user_id' => 1,
        'category_id' => rand(1,2),
        'content' => $faker->paragraph(5),
        'published_at' => $faker->dateTimeThisYear($max = 'now'),
    ];
});


$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});
