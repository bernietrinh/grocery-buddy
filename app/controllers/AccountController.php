<?php

class AccountController extends BaseController {

	public function getLogin() {
		return View::make('account.login');
	}

	public function postLogin() {
		$validator = Validator::make(Input::all(), array(
				'username' => 'required',
				'password' => 'required'
		));

		if ($validator->fails()) {
			return Redirect::route('home')->withErrors($validator)->withInput();
		} else {

			$remember = (Input::has('remember')) ? true : false;
			$auth = Auth::attempt(array(
				'username' => Input::get('username'),
				'password' => Input::get('password'),
				'active' => 1
			), $remember);
		}

		if ($auth) {
			//Redirect to intended page
			return Redirect::intended('/');
		} else {
			return Redirect::route('home')->with('global', '<p class="alert alert-danger">Username or Password is incorrect. Try again.</p>');
		}

		return Redirect::route('home')->with('global', '<p class="alert alert-success">There was a problem logging in. Have you activated your account?</p>');
	}

	public function getLogout() {
		Auth::logout();
		return Redirect::route('home');
	}

	public function getUpdateSettings() {
		$user = User::find(Auth::user()->id);
		return View::make('account.updatesettings', array(
			'user' => $user
		));
	}

	public function postUpdateSettings() {
		$validator = Validator::make(Input::all(), array(
			'password' => 'required',
			'new_password' => 'required|min:6|max:60',
			'new_password_conf' => 'required|same:new_password'
		));

		if($validator->fails()) {
			return Redirect::route('account-update-settings')->withErrors($validator);
		} else {
			$user = User::find(Auth::user()->id);

			$password = Input::get('password');
			$new_password = Input::get('new_password');

			//check if old password is correct
			if(Hash::check($password, $user->getAuthPassword())) {
				$user->password = Hash::make($new_password);

				if($user->save()) {
					return Redirect::route('profile')->with('global', '<p class="alert alert-success">Settings have been updated.</p>');
				}
			} else {
				return Redirect::route('account-update-settings')->with('global', '<p class="alert alert-danger">The password you entered is incorrect.</p>');
			}
		}

		return Redirect::route('account-update-settings')->with('global', '<p class="alert alert-danger">Your settings could not be updated.</p>');
	}

	public function getForgot() {
		return View::make('account.forgot');
	}

	public function postForgot() {
		$validator = Validator::make(Input::all(), array(
			'email' => 'required|email'
		));

		if($validator->fails()) {
			return Redirect::route('account-forgot')->withErrors($validator)->withInput();
		} else {
			$user = User::where('email', '=', Input::get('email'));

			if($user->count()) {
				$user = $user->first();

				//Generate code and password
				$code = str_random(60);
				$password_temp = str_random(10);

				$user->code = $code;

				if($user->save()) {

					Mail::send('emails.auth.forgot_email', array(
						'url' => URL::route('account-recover', $code), 
						'username' => $user->username), 
						function($message) use ($user) {
							$message->to($user->email, $user->username)->subject('Shelf-Life Password Reset');
						}
					);
					
					return Redirect::route('home')->with('global', '<p class="alert alert-success">Recovery has been sent. Please check your email to reactivate your account.</p>');

				}	
			}
		}

		return Redirect::route('account-forgot')->with('global', '<p class="alert alert-danger">Could not request new password.</p>');
	}

	public function getRecover($code) {
		$user = User::where('code', '=', $code);
		if ($user->count()) {
			$user = $user->first();
		}

		return View::make('account.recover', array('username' => $user->username, 'code' => $code));
	}

	public function postRecover() {
		$username = Input::get('name');
		$password = Input::get('new_password');
		$code = Input::get('code');

		$validator = Validator::make(Input::all(), array(
			'new_password' => 'required|min:6|max:60',
			'new_password_conf' => 'required|same:new_password'
		));

		if($validator->fails()) {
			return Redirect::route('account-recover')->withErrors($validator);
		} else {

			$user = User::where('username', '=', $username)->where('code', '=', $code);

			if ($user->count()) {
				$user = $user->first();
				$user->code = '';	
				$user->password = Hash::make($password);

				if($user->save()) {
					return Redirect::route('home')->with('global', '<p class="alert alert-success">Password have been reset.</p>');
				}
		
			}

		} 

		return Redirect::route('home')->with('global', '<p class="alert alert-danger">Your account could not be reset.</p>');
	}

	public function getCreate() {
		return View::make('account.create');
	}

	public function postCreate() {
		$validator = Validator::make(Input::all(),
			array(
				'email' => 'required|max:255|email|unique:users',
				'username' => 'required|max:20|min:3|unique:users',
				'password' => 'required|min:6|max:60',
				'password_conf' => 'required|min:6|max:60|same:password',
				'city' => 'required|alpha'
			)
		);

		if ($validator->fails()) {
			return Redirect::route('account-create')->withErrors($validator)->withInput();
		} else {
			$email = Input::get('email');
			$username = Input::get('username');
			$password = Input::get('password');
			$city = Input::get('city');
			$gender = Input::get('gender');

			// Activation code
			$code = str_random(60);

			$create = User::create(array(
				'email' => $email,
				'username' => $username,
				'password' => Hash::make($password),
				'code' => $code,
				'active' => 0,
				'city' => $city,
				'gender' => $gender
			));

			if($create) {
				//send email
				Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code), 'username' => $username), 
					function($message) use ($create) {
						$message->to($create->email, $create->username)->subject('Activate your Shelf-Life account');
					}
				);

				//redirect to home page with message
				return Redirect::route('home')->with('global', '<p class="alert alert-success">Account created, please activate your account through your email.</p>');
			}
		}
	}

	public function getActivate($code) {
		$user = User::where('code', '=', $code)->where('active','=',0);

		if($user->count()) {
			$user = $user->first();

			//updated to active user
			$user->active = 1;
			$user->code = '';
			$user->save();

			if($user->save()) {
				return Redirect::route('home')->with('global', '<p class="alert alert-success">Activated! Sign in now</p>');
			}
		}

		return Redirect::route('home')->with('global', '<p class="alert alert-danger">Error activating account. Please try again later.</p>');

	}
}

?>