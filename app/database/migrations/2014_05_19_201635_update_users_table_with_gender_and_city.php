<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTableWithGenderAndCity extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($t) {
			$t->char('gender', 1)->after('active');
			$t->string('city', 50)->after('active');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($t) {
			$t->dropColumn('gender', 'city');
		});
	}

}
