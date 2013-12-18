<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();

		$users = array(
			array(
				'email' => 'karan@onesquarepixel.com',
				'name' => 'Karan',
				'password' => Hash::make('acer321')
				),
			array(
				'email' => 'vyas.deven@gmail.com',
				'name' => 'Deven',
				'password' => Hash::make('belkin321!')
				),
			array(
				'email' => 'amanmahadeshwar@gmail.com',
				'name' => 'Aman',
				'password' => Hash::make('quickWeb21')
				),
			array(
				'email' => 'bladefury3@gmail.com',
				'name' => 'Sidharath',
				'password' => Hash::make('vaioewq!')
				)
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
