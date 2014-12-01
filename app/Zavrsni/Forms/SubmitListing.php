<?php namespace Zavrsni\Forms;

use Laracasts\Validation\FormValidator;

class SubmitListing extends FormValidator
{
    /**
     * Validation rules for submitting a listing
     *
     * @var array
     */
    protected $rules = [
        'title'       => 'required|unique:listings',
        'description' => 'required',
        'website'     => 'required',
        'address'     => 'required',
        'place_id'    => 'required',
        'geo_x'       => 'required',
        'geo_y'       => 'required',
    ];

} 