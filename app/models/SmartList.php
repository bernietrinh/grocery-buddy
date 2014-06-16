<?php

class SmartList extends Eloquent {
	protected $fillable = array('item_id', 'user_id');
	protected $table = 'smart_lists';

	public static function getShelfItems($user_id, $item_id) {
		$shelf_items = Shelf::where('user_id', '=', $user_id)->where('item_id', '=', $item_id);
		return $shelf_items;
	}

	public static function itemsJson($term) {
		$items_array = Item::whereRaw("match (`name`) against ('{$term}*' IN BOOLEAN MODE)")->get();
		$items = array();

		foreach ($items_array as $item) {
			$items[] = array(
				'id' => $item->id,
				'value' => $item->name,
				'desc' => $item->category
			);
		}

		return json_encode($items);
	}

}

?>