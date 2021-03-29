<?php

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name(10),
        'description' => $faker->text(110),
        'price' => rand(1, 10),
        'category_id' => rand(1, 10),
    ];
});
