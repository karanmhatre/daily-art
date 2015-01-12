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
				'password' => Hash::make('peQ7Oe7Z')
				),
			array(
				'email' => 'tarun@genii.in',
				'name' => 'Tarun',
				'password' => Hash::make('28W163yU')
				),
			array(
				'email' => 'sidharath@genii.in',
				'name' => 'Sidhu',
				'password' => Hash::make('ULQ1JA2c')
				),
			array(
				'email' => 'sasha@genii.in',
				'name' => 'Sasha',
				'password' => Hash::make('ma1Pc5zo')
				),
			array(
				'email' => 'gandhali@genii.in',
				'name' => 'Gandhali',
				'password' => Hash::make('97C9zw4m')
				),
			array(
				'email' => 'shoaib@genii.in',
				'name' => 'Shoaib',
				'password' => Hash::make('P738B3qR')
				),
			array(
				'email' => 'aakash@genii.in',
				'name' => 'Aakash',
				'password' => Hash::make('9kZjq2hQ')
				),
			array(
				'email' => 'rohitash@genii.in',
				'name' => 'Rohitash',
				'password' => Hash::make('7MO3438w')
				),
			array(
				'email' => 'nitish@genii.in',
				'name' => 'Nitish',
				'password' => Hash::make('veeQ4qhW')
				),
			array(
				'email' => 'aditya@genii.in',
				'name' => 'Aditya',
				'password' => Hash::make('8NcVS11D')
				),
			array(
				'email' => 'vishanka_14@hotmail.com',
				'name' => 'Vishanka',
				'password' => Hash::make('1402t6zW')
				),
			array(
				'email' => 'hetang@genii.in',
				'name' => 'Hetang',
				'password' => Hash::make('yK2HQ3tq')
				),
			array(
				'email' => 'amanmahadeshwar@gmail.com',
				'name' => 'Aman',
				'password' => Hash::make('18d8ElIs')
				),
			array(
				'email' => 'rewakulkarnni@gmail.come',
				'name' => 'Rewa',
				'password' => Hash::make('y6H19wPa')
				),
			array(
				'email' => 'archuaiyer@gmail.com',
				'name' => 'Archua',
				'password' => Hash::make('5c5aAqJR')
				),
			array(
				'email' => 'tanay@genii.in',
				'name' => 'Tanay',
				'password' => Hash::make('y4143B8X')
				),
			array(
				'email' => 'akshay@genii.in',
				'name' => 'Akshay',
				'password' => Hash::make('m617PoRG')
				),
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
