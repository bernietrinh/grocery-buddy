<?php

class SmartList extends Eloquent {
	protected $table = 'smart_lists';

	public static function joinListAndItems($item_id, $user_id) {
		$grocery_items = DB::table('smart_lists')->join('items', 'items.id', '=', 'smart_lists.item_id')->join('shelf','shelf.item_id','=','smart_lists.item_id')->where('items.id', '=', $item_id)->where('shelf.user_id', '=', $user_id)->orderBy('purchase_date', 'desc')->first();

		return $grocery_items;


	}

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