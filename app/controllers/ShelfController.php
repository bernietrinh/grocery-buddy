<?php

class ShelfController extends BaseController {

	public function getShelf() {
		//retrieving shelf items by place
		$fridge_items = Auth::user()->shelf('fridge');
		$freezer_items = Auth::user()->shelf('freezer');
		$pantry_items = Auth::user()->shelf('pantry');

		return View::make('shelf.index', array(
			'fridge_items' => $fridge_items,
			'freezer_items' => $freezer_items,
			'pantry_items' => $pantry_items
		));
	}

	public function getAddToShelf() {
		return View::make('shelf.add');
	}

	public function postAddToShelf() {
		//custom validation messages
		$messages = array(
			'item_name.required' => 'the item is required.',
			'item_name.exists' => 'the item is not valid',
			'purchase.before' => "the purchase date must be on or before today's date",
			'expiry.after' => "the expiry date must be later than today's date"
		);

		//validation
		$validator = Validator::make(Input::all(), array(
			'item_name' => 'required|exists:items,name',
			'purchase' => 'required|date:before'.date("Y-m-d", time()+ (24 * 60 * 60)),
			'expiry' => 'required|date:after'.date("Y-m-d", time()),
			'brand' => 'min:2',
			'price' => 'required|numeric'
		), $messages);


		if ($validator->fails()) {
			//validation errors
			return Redirect::route('shelf-add')->withErrors($validator)->withInput();
		} else {
			$user_id = Auth::user()->id;
			$item_id = Input::get('item_id');
			$place = Input::get('place');
			$purchase = Input::get('purchase');
			$expiry = Input::get('expiry');
			$brand = (Input::has('brand')) ? Input::get('brand') : 'N/A';
			$quantity = Input::get('quantity');
			$location = (Input::has('location')) ? Input::get('location') : 'N/A';
			$price = Input::get('price');
			$desc = Input::get('desc');
			$sale = (Input::has('sale')) ? true : false;

			//add to shelf table
			$addToShelf = Shelf::create(array(
				'item_id' => $item_id,
				'user_id' => $user_id,
				'place' => $place,
				'purchase_date' => $purchase,
				'expiry_date' => $expiry,
				'brand' => $brand,
				'quantity' => $quantity,
				'location' => $location,
				'price' => $price,
				'description' => $desc,
				'sale' => $sale
			));

			if ($addToShelf) {
				return Redirect::route('shelf')->with('global', '<p class="alert alert-success">item has been added to your shelf</p>');
			}
		}
	}

	public function getDetailsShelf($id) {
		$item = Shelf::getItem($id);

		//if the item does not belong to the user, redirect back to shelf
		if ($item->user_id != Auth::user()->id) {
			return Redirect::route('shelf');
		}

		return View::make('shelf.details', array(
			'item' => $item
		));
	}

	public function getEditShelf($id) {
		$item = Shelf::getItem($id);

		if ($item->user_id != Auth::user()->id) {
			return Redirect::route('shelf');
		}
		return View::make('shelf.edit', array(
			'item' => $item
		));
	}

	public function postEditShelf() {
		//custom validaiton messages
		$messages = array(
			'purchase.before' => "the purchase date must be before today's date",
			'expiry.after' => "the expiry date must be later than today's date"
		);

		//validation
		$validator = Validator::make(Input::all(), array(
			'purchase' => 'required|date:before'.date("Y-m-d", time()),
			'expiry' => 'required|date:after'.date("Y-m-d", time()),
			'brand' => 'min:2',
			'price' => 'required|numeric'
		));

		//redirect with errors
		if($validator->fails()) {
			return Redirect::route('shelf-edit')->withErrors($validator)->withInput();
		} else {
			//add to shelf table
			$item = Shelf::find(Input::get('shelf_id'));

			$item->user_id = Auth::user()->id;
			$item->item_id = Input::get('item_id');
			$item->place = Input::get('place');
			$item->purchase_date = Input::get('purchase');
			$item->expiry_date = Input::get('expiry');
			$item->brand = Input::has('brand') ? Input::get('brand') : 'N/A';
			$item->quantity = Input::get('quantity');
			$item->location = (Input::has('location')) ? Input::get('location') : 'N/A';
			$item->price = Input::get('price');
			$item->sale = (Input::has('sale')) ? true : false;
			$item->description = (Input::has('description') ? Input::get('description') : '');

			$editShelfItem = $item->save();

			if ($editShelfItem) {
				return Redirect::route('shelf')->with('global', 'item has been updated.');
			} else {
				return Redirect::route('shelf-edit')->with('global', '<p class="alert alert-success">there was a problem updating this item.</p>');
			}

		}
	}

	public function postDeleteShelf() {
		$item = Shelf::find(Input::get('shelf_id'));
		$deleted = $item->delete();

		if($deleted) {
			return Redirect::route('shelf')->with('global', '<p class="alert alert-success">item removed.</p>');
		}

		return Redirect::route('shelf')->with('global', '<p class="alert alert-danger">there was a problem removing this item.</p>');

	}
}

