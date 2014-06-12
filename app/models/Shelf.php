<?php

class Shelf extends Eloquent {

	protected $fillable = array(
		'user_id', 
		'item_id', 
		'place',
		'purchase_date',
		'expiry_date',
		'brand',
		'quantity',
		'location',
		'price',
		'description',
		'sale'
		);

	protected $table = 'shelf';

	public static function getItem($id) {
		$item = self::join('items','shelf.item_id','=','items.id')->where('shelf.id', '=', $id)->select('shelf.*', 'shelf.id as shelf_id','items.id as item_id', 'items.*')->first();

		return $item;
	}


}