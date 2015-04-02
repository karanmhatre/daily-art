<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddAdminToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->boolean('admin');
			$table->string('avatar', 255);
			$table->string('forgot_token', 255);
			$table->string('register_code', 255);
			$table->integer('days_missed');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			 $table->dropColumn('admin','avatar','forgot_token','register_code','days_missed');
		});
	}

}
