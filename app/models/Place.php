<?php

class Place extends \Eloquent {
    protected $fillable = [];

    public function users()
    {
        return $this->hasMany('User');
    }

    public function listings()
    {
        return $this->hasMany('Listing');
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLatitude()
    {
        return $this->lat;
    }

    public function getLongitude()
    {
        return $this->lng;
    }
}