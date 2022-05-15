<?php

use Faker\Generator as Faker;
use WiGeeky\Todo\Models\Label;

$factory->define(Label::class, function (Faker $faker) {
    return [
      'title' => $faker->unique()->words(6, true),
    ];
});