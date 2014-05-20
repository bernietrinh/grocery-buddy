<?php

class SmartList extends Eloquent {
	protected $table = 'smart_lists';

	public function checked() {

	}

	public static function join($item_id) {
		$x = DB::table('smart_lists')->join('items', 'items.id', '=', 'smart_lists.item_id')->where('items.id', '=', $item_id)->get();
		return $x;
	}
}

?>