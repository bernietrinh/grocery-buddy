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

	public static function brandsJson($term) {
		$brand_array = self::whereRaw("match (`brand`) against ('{$term}*' IN BOOLEAN MODE)")->get();
		$brands = array();

		foreach ($brand_array as $brand) {
			$brands[] = array(
				'id' => $brand->id,
				'value' => $brand->brand,
				'desc' => $brand->location
			);
		}

		return json_encode($brands);
	}


}