<?php

Route::get('/', function()
{
	return View::make('form');
});

Route::post('/', function()	{
	$rules = array(
		'link' => 'required|url'
	);
	
	$validation = Validator::make(Input::all(), $rules);
	
	if($validation->fails())	{
		return Redirect::to('/')
			->withInput()
			->withErrors($validation);
	}	else	{
		$link = Link::where('url', '=', Input::get('link'))
			->first();
		if($link)	{
			return Redirect::to('/')
				->withInput()
				->with('link', $link->hash);
		}	else	{
			do	{
				$newHash = Str::random(6);
			}	while(Link::where('hash','=', $newHash)
					->count() >0);
					
			Link::create(array(
				'url' => Input::get('link'),
				'hash' => $newHash
			));
			return Redirect::to('/')
				->withInput()
				->with('link', $newHash);
		}
	}
});

Route::get('{hash}',function($hash) {
  //First we check if the hash is from a URL from our database
  $link = Link::where('hash','=',$hash)
	->first();
  //If found, we redirect to the URL
  if($link) {
    return Redirect::to($link->url);
    //If not found, we redirect to index page with error message
  } else {
      return Redirect::to('/')
    ->with('message','Invalid Link');
  }
})->where('hash', '[0-9a-zA-Z]{6}');