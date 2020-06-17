<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Book;
use App\Models\Author;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->title(),
        'code' => substr($faker->uuid, 0, 5), 
        'author_id' => factory(Author::class)->create()->id
    ];
});
