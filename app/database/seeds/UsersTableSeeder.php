<?php

class UsersTableSeeder extends Seeder {

	public function run() {
		DB::table('users')->delete();

		$users = array(
			array(
				'username' => 'bernie',
				'password' => Hash::make('password'),
				'email' => 'bernie.trinh26@gmail.com'
			),

			array(
				'username' => 'mandy',
				'password' => Hash::make('password'),
				'email' => 'mandyfok@gmail.com'
			)
		);

		DB::table('users')->insert($users);

		//php artisan db::seed
	}
}