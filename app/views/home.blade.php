@extends('layout.main')

@section('content')
	@if(Auth::check())
		<p>Hello, {{ Auth::user()->username }}</p>

		@{{ dd($recipe) }}
	@else
		<p>Not signed in.</p>


	@endif
@stop

<?php
// // APP ID:fd5e97cf
// // APP KEY: da1a7e087d162d6b10f28e948c8064b4
// $url = "http://api.yummly.com/v1/api/recipes?_app_id=fd5e97cf&_app_key=da1a7e087d162d6b10f28e948c8064b4&allowedIngredient[]=blueberries";

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// $result = curl_exec($ch);

// $response = json_decode($result); 
// curl_close($ch);
// echo '<pre>'; 
// print_r($response);
// echo '</pre>'; 

// echo $response->matches[0]->recipeName;
// ?>