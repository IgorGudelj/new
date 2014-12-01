<?php

use Zavrsni\Forms\SubmitListing as SubmitListingForm;
use Laracasts\Validation\FormValidationException;


class ListingsController extends \BaseController {

    protected $listingForm;

    public function __construct(SubmitListingForm $listingForm)
    {
        $this->listingForm = $listingForm;

        //Check CSRF token on POST
        $this->beforeFilter('csrf', array('on' => 'post'));

        // Set up Auth Filters
        $this->beforeFilter('auth', ['only' => ['create', 'edit', 'update', 'destroy']]);

        // Set up Edit Filters
        $this->beforeFilter('canEditListing', ['only' => ['edit', 'update', 'destroy']]);
    }

	/**
	 * Display a listing of listings
	 *
	 * @return Response
	 */
	public function index()
	{
		$listings = Listing::with('user')->get();

		return View::make('listings.index', compact('listings'));
	}

	/**
	 * Show the form for creating a new listing
	 *
	 * @return Response
	 */
	public function create()
	{
        $places = Place::orderBy('name')->get()->lists('name', 'id');

		return View::make('listings.create')->with('places', $places);
	}

	/**
	 * Store a newly created listing in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::except('_token', 'images');
        $files = Input::file('images');

        try
        {
            $this->listingForm->validate($input);

            $listing = Listing::create($input);
            $listing->user_id = Sentry::getUser()->id;
            $listing->save();


            if(isset($files))
            {
                foreach ($files as $file)
                {
                    $rules = array(
                        'required' => 'true',
                        'file'     => 'mimes:png,gif,jpeg,jpg|max:20000'
                    );
                    $imageValidator = Validator::make(array('file' => $file), $rules);
                    if ($imageValidator->passes())
                    {
                        $destinationPath = 'img/';
                        if (isset($file))
                        {
                            $filename = $file->getClientOriginalName();
                            $file->move($destinationPath, $filename);
                        } else break;
                        $image = new Image;
                        $image->listing_id = $listing->id;
                        $image->filename = url() . '/' . $destinationPath . $filename;
                        $image->save();
                    }
                }
            }

        }
        catch (FormValidationException $e)
        {
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

		return Redirect::route('listings.index');
	}

	/**
	 * Display the specified listing.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$listing = Listing::with('user')->with('images')->findOrFail($id);
        $user = $listing->user;
        $images = $listing->images;

		return View::make('listings.show', compact('listing', 'user', 'images'));
	}

	/**
	 * Show the form for editing the specified listing.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$listing = Listing::find($id);
        $places = Place::orderBy('name')->get()->lists('name', 'id');

		return View::make('listings.edit', compact('listing', 'places'));
	}

	/**
	 * Update the specified listing in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$listing = Listing::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Listing::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$listing->update($data);

		return Redirect::route('listings.index');
	}

	/**
	 * Remove the specified listing from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Listing::destroy($id);

		return Redirect::route('listings.index');
	}

    public function showByUserId($id)
    {
        $listings = Listing::with('user')->where('user_id', $id)->get();

        return View::make('listings.index', compact('listings'));
    }

}
