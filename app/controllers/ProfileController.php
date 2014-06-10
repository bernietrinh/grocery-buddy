<?php

class ProfileController extends BaseController {

	public function getProfile() {
		$expirings = Auth::user()->expiring();
		$count = Auth::user()->expiring()->count();

		foreach($expirings as $item) {
			$name = $item->name;
			$ingredient = strtolower(str_replace(' ', '+', $item->name));
			 $url = "http://api.yummly.com/v1/api/recipes?_app_id=fd5e97cf&_app_key=da1a7e087d162d6b10f28e948c8064b4&allowedIngredient[]=".$ingredient;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);

			$response = json_decode($result);


			$response = (array)$response;
			$response['shelf_ingredient'] = $name;
			$response = (object)$response;

			if($response) {
				$recipes[] = $response;
			}
		}

		return View::make('profile', array(
			'recipes' => $recipes,
			'expirings' => $expirings,
			'count' => $count
		));
	}

	public function getRecipe($id) {
		$recipe_url = 'http://api.yummly.com/v1/api/recipe/' . $id . '?_app_id=fd5e97cf&_app_key=da1a7e087d162d6b10f28e948c8064b4';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $recipe_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);

		$recipe = json_decode($result);

		return View::make('recipe', array(
			'recipe' => $recipe
		));
	}
}
//http://api.yummly.com/v1/api/recipe/Quick-sriracha-beef-lettuce-wraps-309227?_app_id=fd5e97cf&_app_key=da1a7e087d162d6b10f28e948c8064b4
?>