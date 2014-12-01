<?php

class Listing extends \Eloquent {
    protected $fillable = [];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function place()
    {
        return $this->hasOne('Place', 'id', 'place_id');
    }

    public function images()
    {
        return $this->hasMany('Image');
    }

    public function isCurrent()
    {
        if (!Sentry::check()) return false;
        return Sentry::getUser()->id == $this->user->id;
    }
}