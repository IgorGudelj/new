<?php


use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\UserTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    protected $fillable = array('name', 'address', 'city', 'oib', 'email', 'password');

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

    public function place()
    {
        return $this->hasOne('Place', 'id', 'place_id');
    }

    public function getID()
    {
        return (int)$this->id;
    }

    public function getFullnameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getOIB()
    {
        return $this->oib;
    }

    // Checks if the current user object is the currently authenticated user
    public function isCurrent()
    {
        if (!Sentry::check()) return false;

        return Sentry::getUser()->id == $this->id;
    }

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
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

    public function getPlaceName()
    {
        //User is not forced to add his place, so we must check if place exists
        //http://stackoverflow.com/questions/23910553/laravel-check-if-related-model-exists

        if (count($this->place)) return $this->place->getName();

        return '';
    }

}