<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Comment;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        // 'parent_id' => function() {
        //     return factory('App/Comment')->create()->id;
        // },
        'name' => $faker->name,
        'body' => Str::random(160)
    ];
});
