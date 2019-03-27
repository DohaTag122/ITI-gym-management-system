<?php

use Faker\Generator as Faker;

$factory->define(App\Gym::class, function (Faker $faker) {
    return [
        "name"=>$faker->name,
        "image"=>$faker->image($dir = '/tmp', $width = 640, $height = 480),
        "city_manager_id"=>function(){
            return factory(App\User::class)->create()->id;
        },
        "city_id"=> function(){
            return factory(App\City::class)->create()->id;
        }
    ];
});
