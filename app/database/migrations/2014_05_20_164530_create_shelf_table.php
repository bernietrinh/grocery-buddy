<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShelfTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shelf', function($t) {
			$t->increments('id');
			$t->integer('user_id');
			$t->integer('item_id');
			$t->foreign('user_id')->references('id')->on('users');
			$t->foreign('item_id')->references('id')->on('items');
			$t->string('place');
			$t->date('purchase_date');
			$t->date('expiry_date');
			$t->string('brand');
			$t->integer('quantity');
			$t->string('location');
			$t->decimal('price', 6, 2);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shelf');
	}

}
