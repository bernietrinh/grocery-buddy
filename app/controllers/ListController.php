<?php

Class ListController extends BaseController {

	public function getList() {
		$list_items = Auth::user()->smartLists;
		return View::make('list', array(
			'list_items' => $list_items
		));
	}

	public function postList() {
		
	}

}
?>