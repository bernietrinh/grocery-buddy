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

	public function getBrand() {
		$term = Input::get('brand');
		return Shelf::brandsJson($term);
	}

	public function getAddToShelf() {
		return View::make('shelf.add');
	}

	public function postAddToShelf() {
		//custom validation messages
		$messages = array(
			'item_name.required' => 'the item is required.',
			'item_name.exists' => 'the item is not valid',
			'purchase.before' => "the purchase date must be before today's date",
			'expiry.after' => "the expiry date must be later than today's date"
		);

		//validation
		$validator = Validator::make(Input::all(), array(
			'item_name' => 'required|exists:items,name',
			'purchase' => 'required|date:before'.date("Y-m-d", time()),
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
				return Redirect::route('shelf')->with('global', 'item has been added to your shelf');
			}
		}
	}

	public function getEditShelf() {
		return View::make('shelf.edit');
	}
}

