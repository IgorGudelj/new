<?php

class Image extends \Eloquent {
    protected $fillable = [];

    public function listing()
    {
        return $this->belongsTo('Listing');
    }
}