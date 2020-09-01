<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
        'price' => $faker->numberBetween(100,1000),
        'image' => 'uploads/products/book.png',
        'description' => $faker->paragraph(5),
    ];
});
