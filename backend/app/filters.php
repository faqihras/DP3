<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{

});

App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/



Route::filter('authx', function($route, $request)
{
    
    if (Auth::guest())
    {
        if (Request::ajax())
        {
            $response = array(
                "status" => array(
                    "error" => 1,
                    "errorCode" => 0,
                    "message" => 'Unauthorized page'
                )
            );
            return Response::json($response);
        }
        else
        {
            $response = array(
                "status" => array(
                    "error" => 1,
                    "errorCode" => 0,
                    "message" => 'Unauthorized page'
                )
            );
            return Response::json($response);
        }
    }
        
//    if (Auth::guest())
//    {
//        return Redirect::guest('/admin');
//    }
});

Route::filter('authadmin', function()
{
    if(null!=Session::get('typeLogin')){
    $value = Session::get('typeLogin');

    if ($value!='1')
    {
       $response = array(
                "status" => array(
                    "error" => 1,
                    "errorCode" => $value,
                    "message" => 'Unauthorized admin page.'
                )
            );
            return Response::json($response);
    }
    
    }else{
        $response = array(
                "status" => array(
                    "error" => 2,
                    "errorCode" => 0,
                    "message" => 'Unauthorized admin page.'
                )
            );
            return Response::json($response);
    }
});

Route::filter('authuser', function()
{
    if(!Session::has('user')){
          $response = array(
                "status" => array(
                    "error" => 2,
                    "errorCode" => 0,
                    "message" => 'Unauthorized user page.'
                )
            );
            return Response::json($response);
    }   
});
/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		//throw new Illuminate\Session\TokenMismatchException;
	}
});
