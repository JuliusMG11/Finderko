<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
	$title = $faker->words(4, true);

	return [
		'user_id' => 1,
		'title' => ucfirst($title),
		'slug' => str_slug($title),
		'text' => $faker->paragraphs(5, true),
		'type' => $faker->paragraphs(1, true),
		'start_work' => $faker->time,
		'end_work' => $faker->time,
		'date_work' => date('Y-m-d'),
	];
});
