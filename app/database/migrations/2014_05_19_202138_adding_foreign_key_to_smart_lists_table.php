<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingForeignKeyToSmartListsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('smart_lists', function($t) {
			$t->foreign('user_id')->references('id')->on('users');
			$t->foreign('item_id')->references('id')->on('items');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('smart_lists', function($t) {
			$t->dropForeign('smart_lists_user_id_foreign');
			$t->dropForeign('smart_lists_item_id_foreign');
		});
	}

}
