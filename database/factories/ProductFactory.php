<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => Str::limit($faker->sentence, 15),
        'price' => $faker->randomFloat(2, 100, 10000),
        'save' => round($faker->randomFloat(2, 1, 99), 2),
        'colors' => Arr::random(
            ['red', 'blue', 'black', 'green', 'yellow', 'pink', 'white', 'teal'],
            3
        ),
        'qty' => random_int(1, 50),
        'sizes' => Arr::random(
            ['x', 'xl', 'xxl', 'xxxl', 'xxxxl'],
            3
        ),
    ];
});
