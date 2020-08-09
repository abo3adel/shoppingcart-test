<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Abo3adel\ShoppingCart\CartItem;
use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(CartItem::class, function (Faker $faker) {
    $buyable = factory(Product::class)->create();
    return [
        'user_id' => function () {
            return (User::all()->random())->id;
        },
        'qty' => random_int(1, 530),
        'size' => random_int(1, 3),
        'color' => random_int(1, 4),
        'price' => $faker->randomFloat(2, 100, 5634),
        'options' => json_encode(['lite' => true]),
        'buyable_id' => $buyable->id,
        'buyable_type' => Product::class,
    ];
});
