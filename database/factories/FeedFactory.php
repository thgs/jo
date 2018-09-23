<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Feed::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'url' => $faker->url,
        'update_every' => 15,
        'user_id' => factory(App\User::class)->create()->id,
    ];
});
