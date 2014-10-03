<?php


Route::filter('api.auth', function()
{

    // ...get database user
//    if (Input::server("token") !== $user->token)
//    {
//        App::abort(400, "Invalid token");
//    }

});

Route::filter('api.limit', function()
    {
        // count...
    });


Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
