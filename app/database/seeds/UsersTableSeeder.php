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
				'password' => Hash::make('acer321')
				),
			array(
				'email' => 'deven@genii.in',
				'name' => 'Deven',
				'password' => Hash::make('belkin321!')
				)
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
