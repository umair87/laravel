<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'post_title' => \Faker\Provider\Lorem::sentence($nbWords = 6, $variableNbWords = true),
        'post_content' => \Faker\Provider\Lorem::paragraph($nbSentences = 100, $variableNbSentences = true),
        'author' => \Faker\Provider\Base::numberBetween($min = 1, $max = 3),
        'topic' => \Faker\Provider\Base::numberBetween($min = 1, $max = 9),
    ];
});
