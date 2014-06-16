<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable = array('email', 'username', 'password', 'password_temp', 'code', 'active');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function expiring() {
		return $this->hasMany('Shelf')->join('items','shelf.item_id','=','items.id')->where('expiry_date', '<=', date('Y-m-d', (time() + (7 * 24 * 60 * 60))))->where('expired','=','0')->where('expiry_date', '!=', 'null')->orderBy('expiry_date')->take(10)->select('shelf.*', 'items.*', 'items.id as item_id', 'shelf.id as shelf_id')->get();
	}

	public function smartLists()
	{
		return $this->hasMany('SmartList')->join('items','smart_lists.item_id', '=', 'items.id')->select('smart_lists.*', 'items.*', 'items.id as item_id', 'smart_lists.id as list_id');
	}

	public function listWithShelf($item_id)
	{
		return $this->hasMany('SmartList')->join('shelf','shelf.item_id', '=', 'smart_lists.item_id')->join('items','items.id', '=', 'smart_lists.item_id')->where('shelf.item_id', '=', $item_id)->select('smart_lists.*', 'shelf.*', 'shelf.id as shelf_id', 'smart_lists.id as list_id', 'items.*', 'items.id as item_id')->first();
	}

	public function shelf($place) {
		return $this->hasMany('Shelf')->join('items','shelf.item_id','=','items.id')->where('shelf.place', '=', $place)->orderBy('expiry_date')->where('expired','=','0')->select('shelf.*', 'items.*', 'items.id as item_id', 'shelf.id as shelf_id')->get();
	}

}
