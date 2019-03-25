<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
    return [
        'tag_name' => \Faker\Provider\Base::randomElement($array = array (
            'Artificial Intelligence',
            'Basic Income',
            'Automation',
            'Abuse',
            'About',
            'Banking',
            'Baseball',
            'Baby',
            'Careers',
            'Car',
            'Data',
            'Earth',
            'Easter',
            'Technology',
            'Tech',
            'Television',
            'Photography',
            'Photos',
            'PHP',
            'We',
            'Web Development',
            'Web Design',
            'Weight Loss',
            'Wedding',
            'He',
            'Health',
            'Health Care',
            'Headlines',
            'Health Food',
            'Digital',
            'Digital Marketing',
            'Diet',
            'Digital Transformation',
            'Diversity',
            'Love'

        ))
    ];
});
