<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Comment;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'parent_id' => NULL,
        'name' => $faker->name,
        'body' => Str::random(160)
    ];
});
