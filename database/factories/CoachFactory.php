<?php

use Faker\Generator as Faker;

$factory->define(App\Coach::class, function (Faker $faker) {
    return [
        "name"=> $faker->name,
        "gym_id"=>function(){
            return factory(App\Gym::class)->create()->id;
        }
    ];
});
