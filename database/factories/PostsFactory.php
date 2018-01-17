<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'sortdesc' => $faker->paragraph,
        'postbody' => $faker->paragraph,
        'main_img' => $faker->unique->imageUrl(1280,720),
        'medium_img' => $faker->unique->imageUrl(1024,576),
        'thumb_img' => $faker->unique->imageUrl(250,250),
        'metatitle' => $faker->sentence(3),
        'metadesc' => $faker->sentence(3),
        'metakeywords' => $faker->words(3, true),
        'seotitle' => $faker->slug,
        'sortdesc' => $faker->sentence(3),
        'active' => $faker->boolean(true),
        'created_at' => $faker->dateTime($max = 'now'),
        'updated_at' => $faker->dateTimeThisMonth($max = 'now')


    ];
});
