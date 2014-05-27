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

}