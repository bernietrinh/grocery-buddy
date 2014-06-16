<?php

Class ListController extends BaseController {

	public function getList() {
		$list_items = Auth::user()->smartLists;

		foreach($list_items as $list) {
			$shelf = Auth::user()->listWithShelf($list->item_id);
			if ($shelf) {
				$items[] = $shelf;
			} else {
				$items[] = $list;
			}

		}

		if (Auth::user()->smartLists->count() > 0) {
			foreach($items as $list) {
				json_decode($list);
			}
		} else {
			$items = null;	
		}



		return View::make('list', array(
			'items' => $items
		));
	}

	public function postList() {
		$user = Auth::user()->id;
		$item_id = Input::get('item'); 

		if (Input::has('add_to_shelf')) {
			//add to shelf
			$messages = array(
				'purchase.before' => "the purchase date must be on or before today's date.",
				'expiry.after' => "the expiry date must be later than today's date."
			);

			if (Input::has('perishable')) {
				$expiry_val = 'required|date:after'.date("Y-m-d", time());
			} else {
				$expiry_val = '';
			}

			$validator = Validator::make(Input::all(), array(
				'purchase' => 'required|date|before:'.date("Y-m-d", time() + (24 * 60 * 60)),
				'expiry' => 'required|date|after:'.date("Y-m-d", time()),
				'brand' => 'min:2',
				'price' => 'required|numeric'
			), $messages);

			if ($validator->fails()) {
				//validation errors
				return Redirect::route('smart-list')->withErrors($validator)->withInput();
			} else {
				$place = Input::get('place');
				$purchase = Input::get('purchase');
				$expiry = Input::get('expiry');
				$brand = (Input::has('brand')) ? Input::get('brand') : 'N/A';
				$quantity = Input::get('quantity');
				$location = (Input::has('location')) ? Input::get('location') : 'N/A';
				$price = Input::get('price');
				$description = Input::get('description');
				$sale = (Input::has('sale')) ? true : false;

				//add to shelf table
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
					'sale' => $sale,
					'expired' => 0
				));

				if($addToShelf) {
					$list_item = SmartList::find(Input::get('list_id_add_del'));
					$remove = $list_item->delete();

					if($remove) {
						return Redirect::route('smart-list')->with('global', '<p class="alert alert-success">item has been added to your shelf.');
					} else {
						return Redirect::route('smart-list')->with('global', '<p class="alert alert-danger">there was a problem removing this item.</p>');
					}
				}
			}
		} else if (Input::has('add_to_list')){
			//add to grocery list

			//validation
			$messages = array(
				'required' => 'the item is required.',
				'exists' => 'this item is not valid.'
			);
			$validator = Validator::make(Input::all(), array(
				'addtolist' => 'required|exists:items,name'
			), $messages);

			if ($validator->fails()) {
				//validation errors
				return Redirect::route('smart-list')->withErrors($validator)->withInput();
			} else {
				if (Input::has('listitemid')) {
					$item_id = Input::get('listitemid');
				} else {
					$item = Item::where('name',Input::get('addtolist'))->first();
					$item_id = $item->id;
				}

				$addToList = SmartList::create(array(
					'user_id' => Auth::user()->id,
					'item_id' => $item_id
				));

				return Redirect::route('smart-list')->with('global', '<p class="alert alert-success">successfully added to smart list.</p>');
			}
		}
	}

	public function postDelete() {

		$list_item = SmartList::find(Input::get('list_id_delete'));

		$delete = $list_item->delete();

		if ($delete) {
			return Redirect::route('smart-list')->with('global', '<p class="alert alert-success">item sucessfully removed.</p>');
		} else {
			return Redirect::route('smart-list')->with('global', '<p class="alert alert-danger">there was a problem removing this item.</p>');
		}

	}

	public function getAdd() {
		$term = Input::get('term');
		return SmartList::itemsJson($term);
	}

}
?>