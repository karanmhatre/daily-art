<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArtCountToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->integer('art_count')->default(0);
			$table->text('link');
			$table->boolean('subscribe')->default(1);
			$table->integer('longest_streak');
			$table->integer('current_streak');
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
			$table->dropColumn('art_count', 'longest_streak', 'current_streak', 'link');
		});
	}

}
