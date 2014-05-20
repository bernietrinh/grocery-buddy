<?php

Class ListController extends BaseController {

	public function getList() {
		$list_items = Auth::user()->smartLists;
		
		foreach ($list_items as $list) {
			$item[] = SmartList::join($list['item_id']);
		}
		
		return View::make('list', array(
			'items' => $item
		));
	}

	public function postList() {
		$item_id = Input::get('item');

		if (Input::has('list_remove')) {
			//delete from grocery list
			SmartList::delete($item_id);

		} else if (Input::has('list_add_to_shelf')) {
			//add to shelf
			$validator = Validator::make(Input::all(), array(
				'purchase' => 'required',
				'expiry' => 'required',
				'brand' => 'required',
				'quantity' => 'required',
				'location' => 'required',
				'price' => 'required',
			));

			if ($validator->fails) {
				//validation errors
			} else {
				//add to shelf db
			}

		} else {
			//add to grocery list
		}

		//return $add. '<br>' . $remove . '<br>' . $item;

		// $id = Auth::user()->id;
		// return 'Item: id' . $item . 'User id:' . $id;
	}

}
?>