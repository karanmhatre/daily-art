<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();

		$users = array(
			array(
				'email' => 'karan@genii.in',
				'name' => 'Karan',
				'password' => Hash::make('acer321'),
				'avatar' => 'img/test/dp-1.jpg'
			),
			array(
				'email' => 'deven@genii.in',
				'name' => 'Deven',
				'password' => Hash::make('peQ7Oe7Z'),
				'avatar' => 'img/test/dp-2.jpg'
			),
			array(
				'email' => 'tarun@genii.in',
				'name' => 'Tarun',
				'password' => Hash::make('28W163yU'),
				'avatar' => null
			),
			array(
				'email' => 'sidharath@genii.in',
				'name' => 'Sidhu',
				'password' => Hash::make('ULQ1JA2c'),
				'avatar' => 'img/test/dp-3.jpg'
			)
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
