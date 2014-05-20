<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingDescColumnToShelfTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shelf', function($table)
		{
		    $table->string('description');
		    $table->boolean('sale');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('shelf', function($table)
		{
		    $table->dropColumn('description');
		    $table->dropColumn('sale');
		});
	}

}
