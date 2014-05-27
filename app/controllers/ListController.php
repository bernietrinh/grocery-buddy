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
		
		return View::make('list', array(
			'items' => $items
		));
	}

	public function postList() {
		$user = Auth::user()->id;
		$item_id = Input::get('item'); 

		if (Input::has('list_remove')) {

			//delete from grocery list
			$delete = SmartList::where('user_id', '=', $user)->where('item_id', '=', $item_id)->delete();

			
			if ($delete) {
				return Redirect::route('smart-list')->with('global', 'item sucessfully removed');
			}

		} else if (Input::has('add_to_shelf')) {
			//add to shelf
			$validator = Validator::make(Input::all(), array(
				'purchase' => 'required|after:date("Y-m-d")',
				'expiry' => 'required|after:date("Y-m-d")',
				'brand' => 'required|min:2',
				'quantity' => 'required|digits_between:1,100',
				'location' => 'required',
				'price' => 'required'
			));

			if ($validator->fails()) {
				//validation errors
				return Redirect::route('smart-list')->withErrors($validator)->withInput();
			} else {
				$place = Input::get('place');
				$purchase = Input::get('purchase');
				$expiry = Input::get('expiry');
				$brand = Input::get('brand');
				$quantity = Input::get('quantity');
				$location = Input::get('location');
				$price = Input::get('price');
				$description = Input::get('description');
				$sale = (Input::has('sale')) ? true : false;

				//add to shelf db
				$addToShelf = Shelf::create(array(
					'item_id' => $item_id,
					'user_id' => $user,
					'place' => $place,
					'purchase_date' => $purchase,
					'expiry_date' => $expiry,
					'brand' => $brand,
					'quantity' => $quantity,
					'location' => $location,
					'price' => $price,
					'description' => $description,
					'sale' => $sale
				));

				if($addToShelf) {
					$remove = SmartList::where('user_id', '=', $user)->where('item_id', '=', $item_id)->delete();

					if($remove) {
						return Redirect::route('smart-list')->with('global', 'item has been added to your shelf');
					}
				}
			}
		} else if (Input::has('add_to_list')){
			//add to grocery list

			//validation
			$validator = Validator::make(Input::all(), array(
				'addtolist' => 'required|exists:items,name'
			));

			if ($validator->fails()) {
				//validation errors
				return Redirect::route('smart-list')->withErrors($validator)->withInput();
			} else {
				$item_id = Input::get('listitemid');

				$addToList = SmartList::create(array(
					'user_id' => $user,
					'item_id' => $item_id
				));

				return Redirect::route('smart-list')->with('global', 'successfully added to smart list');
			}
		}
	}

	public function getAdd() {
		$term = Input::get('term');
		return SmartList::itemsJson($term);
	}

}
?>