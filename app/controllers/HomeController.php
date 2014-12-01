<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showIndex()
	{
        $listings = Listing::with('images')->with('user')->paginate(9);
        $json = Listing::with('images')->with('user')->get();

        \Laracasts\Utilities\JavaScript\Facades\JavaScript::put([
            'listings' => $json,
        ]);

		return View::make('home.index', compact('listings'));
	}

}