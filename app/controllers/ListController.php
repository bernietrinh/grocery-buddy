<?php

Class ListController extends BaseController {

	public function getList() {

		
		$list_items = Auth::user()->smartLists;

		foreach ($list_items as $list) {

			$item = SmartList::joinListAndItems($list['item_id'], Auth::user()->id);
			if ($item) {
				$items[] = $item; 
			} else {
				$item = Item::find($list['item_id']);
				$items[] = $item; 
			}
		}

		// 		echo '<pre>'. var_dump($items) .'</pre>';
		// die();
		
		return View::make('list', array(
			'items' => $items
			// 'shelf' => $shelf
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
	}

	public function getAdd() {
		$term = Input::get('term');
		return SmartList::itemsJson($term);
	}

}
?>