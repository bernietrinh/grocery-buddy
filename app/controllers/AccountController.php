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
			return Redirect::route('account-login')->withErrors($validator)->withInput();
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
			return Redirect::route('account-login')->with('global', 'Username or Password is incorrect. Try again.');
		}

		return Redirect::route('account-login')->with('global', 'There was a problem logging in. Have you activated your account?');
	}

	public function getLogout() {
		Auth::logout();
		return Redirect::route('home');
	}

	public function getUpdateSettings() {
		return View::make('account.updatesettings');
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
					return Redirect::route('home')->with('global', 'Settings have been updated.');
				}
			} else {
				return Redirect::route('account-update-settings')->with('global', 'The password you entered is incorrect.');
			}
		}

		return Redirect::route('account-update-settings')->with('global', 'Your settings could not be updated.');
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
							$message->to($user->email, $user->username)->subject('Fridge Password Reset');
						}
					);
					
					return Redirect::route('home')->with('global', 'Recovery has been sent. Please check your email to reactivate your account.');

				}	
			}
		}

		return Redirect::route('account-forgot')->with('global', 'Could not request new password.');
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
					return Redirect::route('account-login')->with('global', 'Password have been reset.');
				}
		
			}

		} 

		return Redirect::route('home')->with('global', 'Your account could not be reset.');
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
				'password_conf' => 'required|min:6|max:60|same:password'
			)
		);

		if ($validator->fails()) {
			return Redirect::route('account-create')->withErrors($validator)->withInput();
		} else {
			$email = Input::get('email');
			$username = Input::get('username');
			$password = Input::get('password');

			// Activation code
			$code = str_random(60);

			$create = User::create(array(
				'email' => $email,
				'username' => $username,
				'password' => Hash::make($password),
				'code' => $code,
				'active' => 0
			));

			if($create) {
				//send email
				Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code), 'username' => $username), 
					function($message) use ($create) {
						$message->to($create->email, $create->username)->subject('Activate your Fridge account');
					}
				);

				//redirect to home page with message
				return Redirect::route('home')->with('global', 'Account created, please activate your account through your email.');
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
				return Redirect::route('home')->with('global', 'Activated! Sign in now');
			}
		}

		return Redirect::route('home')->with('global', 'Error activating account. Please try again later.');

	}
}

?>