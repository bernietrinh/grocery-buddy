<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTimestampsForShelfTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//adding timestamps
		Schema::table('shelf', function($table) {
			$table->timestamps();
		});

		Schema::table('smart_lists', function($table) {
			$table->timestamps();
		});

		Schema::table('items', function($table) {
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//deleting created_at, updated_at
		Schema::table('shelf', function($table)
		{
		    $table->dropColumn('created_at', 'updated_at');
		});

		Schema::table('smart_lists', function($table)
		{
		    $table->dropColumn('created_at', 'updated_at');
		});

		Schema::table('items', function($table)
		{
		    $table->dropColumn('created_at', 'updated_at');
		});
	}

}
