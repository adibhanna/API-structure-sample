<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		for ($i = 1; $i <= 30; $i++)
		{
			\Post::create([
                'title' => $faker->text(),
                'text' => $faker->text(),
                'active' => $faker->boolean()
			]);
		}
	}

}
