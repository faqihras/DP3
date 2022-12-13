<?php
// =============================================
// HOME PAGE ===================================
// =============================================

Route::get('user/registration/allstep/{pil}', 'User\Registration\AllstepController@allstep');
Route::get('user/step3', array('uses' => 'User\Registration\AllstepController@step3'));
Route::post('user/upload', array('uses' => 'User\Registration\RegistrationController@upload'));
Route::post('user/registration', array('uses' => 'User\Registration\RegistrationController@store'));

Route::get('user/loginLabel', 'User\Registration\AllstepController@loginLabel');

//need to be fixed

Route::get('api/user/api/user/auth', function()
{       
    if(null!=Session::get('typeLogin')){
        $value = Session::get('typeLogin');
        
        if($value=='1'){
            $response = array(
                "status" => array(
                    "error" => 999,
                    "errorCode" => 0,
                    "message" => 'Unauthorized perbaiki.'
                )
            );
            return Response::json($response);
        }else if($value=='2'){

        }
    }else{
    $response = array(
                "status" => array(
                    "error" => 999,
                    "errorCode" => 0,
                    "message" => 'Unauthorized perbaiki.'
                )
            );
            return Response::json($response);
    }
});
//
Route::get('/', function()
{

    Session::put('lang', 'end');
	return View::make('view.index'); 
});

Route::get('setLang/{lang?}', function($lang)
{
    if($lang=='id'){
        $response = array(
                    "status" => array(
                        "error" => 0,
                        "errorCode" => 0,
                        "message" => 'sukses'
                    ),
                    "data"=>'id'
                );
    }else{
        $response = array(
                    "status" => array(
                        "error" => 0,
                        "errorCode" => 0,
                        "message" => 'success'
                    ),
                    "data"=>'en'
                );
    }
    Session::put('lang', $lang);
    return Response::json($response);
});

// =============================================
// ADMIN PAGE ==================================
// =============================================
// =============================================
// CATCH ALL ROUTE =============================
// =============================================
// all routes that are not home or api will be redirected to the frontend
// this allows angular to route them

App::missing(function($exception)
{
	return View::make('view.index');
});

// =============================================
// API ROUTES ==================================
// =============================================
// route to process the form

Route::post('api/admin/login', array('uses' => 'Admin\Config\LoginController@store'));
Route::get('api/admin/logout', array('uses' => 'Admin\Config\LogoutController@index'));
Route::get('api/admin/auth', array('uses' => 'Admin\Config\AuthController@index'));

Route::get('api/admin/menu', array(
    'before' => array('auth'),
    'uses' => 'Admin\Config\DashboardController@index'));

Route::get('api/admin/menu/{path?}', array('before' => array('auth') , function($path)
{
    $controller = app()->make('Admin\Config\DashboardController');
    return $controller->callAction('show',array($path));
}))->where(array(
    'path' => '(.*)?'
));

// User
Route::get('out', array('uses' => 'User\Config\LoginController@index'));
Route::post('login', array('uses' => 'User\Config\LoginController@store'));
Route::get('logout', array('uses' => 'User\Config\LogoutController@index'));
Route::get('auth', array('uses' => 'User\Config\AuthController@index'));
Route::post('askus', array('uses' => 'User\AskusController@store'));
Route::get('askLang', array('uses' => 'User\AskusController@askLang'));

Route::get('menu', array(
    'before' => array('authuser'),
    'uses' => 'User\Config\DashboardController@index'));

Route::post('api/user/login', array('uses' => 'User\Config\LoginController@store'));
Route::get('api/user/logout', array('uses' => 'User\Config\LogoutController@index'));
Route::get('api/user/auth', array('uses' => 'User\Config\AuthController@index'));
Route::get('api/user/menu', array(
    'before' => array('auth'),
    'uses' => 'User\Config\DashboardController@index'));

Route::get('api/user/lang/{path?}', array('before' => array('authAdmin') , function($path)
{
    $controller = app()->make('User\Config\LanguageController');
    return $controller->callAction('index',array($path));
}))->where(array(
    'path' => '(.*)?'
));

/**
 * Handle all routes dynamically
 *
 * Specific route actions to override this would go earlier in your routes.php file
 * 
 * http://www.ricktbaker.com/dynamic-routing-laravel-4/
 * 
 * Only authenticated users will be able to access routes that begins with 'api/admin'
 */

Route::post('user/registration'  , array('uses' => 'User\Registration\RegistrationController@store'));
Route::post('user/updatePersonal', array('uses' => 'User\Registration\RegistrationController@updatePersonal'));
Route::post('user/updateInstitution', array('uses' => 'User\Registration\RegistrationController@updateInstitution'));

Route::post('user/uploadPersonal', array('uses' => 'User\Registration\RegistrationController@uploadPersonal'));
Route::post('user/uploadInstitute', array('uses' => 'User\Registration\RegistrationController@uploadInstitute'));

Route::get('user/previewPersonal/{uid}', array('uses' => 'User\Registration\RegistrationpreviewController@previewPersonal'));
Route::get('user/previewInstitute/{uid}', array('uses' => 'User\Registration\RegistrationpreviewController@previewInstitute'));


Route::get('user/apiPreviewPersonal/{uid}', array('uses' => 'User\Registration\RegistrationpreviewController@apiPreviewPersonal'));
Route::get('user/apiPreviewInstitute/{uid}', array('uses' => 'User\Registration\RegistrationpreviewController@apiPreviewInstitute'));



Route::get('user/previewPicPersonal/{uid}', array('uses' => 'User\Registration\RegistrationController@previewPicPersonal'));
Route::get('user/previewPicInstitute/{uid}', array('uses' => 'User\Registration\RegistrationController@previewPicInstitute'));

Route::get('api/profile', array('before' => array('authuser'), 'uses' => 'User\Config\Userapi\ProfileController@index'));



Route::any('api/{path?}', array('before' => array('auth'), function($path)
{
    // Split our path at /
    $bits = explode('/', $path);
    $companyPageAccess=$bits[0];
    // Default the resource to the first part, and if it's empty, default to index
    $resource = ucfirst(array_shift($bits));
    if (!$resource) $resource = "index";
 
    // Actual path to the resource
    $path = app_path() . '/controllers/' . $resource;
        
    // If no action, default to index
    $action = array_shift($bits);
    if (!$action) {
        $action = 'index';
    }
    
    // Namespace
    $namespace = array($resource);
 
    // If the path is a directory, then we keep looking deeper
    while (is_dir($path)) {
        // Add the current part to the namespace array
        $namespace[] = ucfirst($action);
        // Add to the path
        $path .= "/".ucfirst($action);
        
        // If nothing left, default to index
        if (empty($bits)) {
            break;
        }
        // Get rid of the first key in our array
        $action = array_shift($bits);
    }
 
    // Controller should always start with an upper case letter
    $lastIndex = count($namespace) - 1;
    $namespace[$lastIndex] = ucfirst($namespace[$lastIndex]);
    $resource = implode("\\", $namespace);
    
    // If what we have stored in $action is numeric, then it's not a method, default to index
    if (is_numeric($action) || (strpos($action, ',') !== FALSE) ) {
        if(count($bits) > 0){
            if($bits[0] == 'edit'){
                $bits[0] = $action;
                $action = 'edit';
            } 
        } else {            
            array_unshift($bits, $action);
        }
    }
   
    if($action != 'edit'){
        switch (Request::method()){                
            case 'POST'     : $action = 'store'; break;
            case 'PUT'      : $action = 'update'; break;
            case 'PATCH'    : $action = 'patch'; break;
            case 'DELETE'   : $action = 'destroy'; break;
            default         : 
                if(!empty($bits)){
                    $action = 'show';
                } else {
                    $action = 'index';
                }
                break;
        }
    }
    
    // Controllers names should always end with Controller
    $controller = app()->make($resource."Controller");
    //set company access
    
    if($companyPageAccess=='user'){
        Session::put('companyId', Session::get('companyIdUser'));
        Session::put('companyName', Session::get('companyNameUser'));
        Session::put('userId', Session::get('userIdUser'));
        Session::put('userName', Session::get('userNameUser'));
        Session::put('userRolhId', Session::get('userRolhIdUser'));
    }else if($companyPageAccess=='admin'){
        Session::put('companyId', Session::get('companyIdAdmin'));
        Session::put('companyName', Session::get('companyNameAdmin'));
        Session::put('userId', Session::get('userIdAdmin'));
        Session::put('userName', Session::get('userNameAdmin'));
        Session::put('userRolhId', Session::get('userRolhIdAdmin'));
    }
    // Call our controller method with our request type as a prefix
    return $controller->callAction($action,$bits);//strtolower(Request::method()) . "_" .

}))->where(array(
    'path' => '(.*)?'
));


/**
 * Handle all language routes dynamically
 * Language file is in app/lang/{lang}/...
 */
Route::any('lang/{path?}', array('before' => array('auth') , function($path)
{
    $bits = explode('/', $path);
    foreach ($bits as $key => $value) {
        $ucpath[] = ucfirst($value);
    }
    
    $ucpath = implode('/', $ucpath);
    
   App::setLocale( Session::get('locale') );
    

    //$lang = array();

    $lang = Lang::get($ucpath);

//    if (Lang::has($ucpath))
//    {
       // $lang["title"] = Lang::get($ucpath.".title");
       // $lang["column"] = Lang::get($ucpath.".column");
 //   }
    
    return Response::json($lang);
}))->where(array(
    'path' => '(.*)?'
));

//register
Route::any('user/{path?}',array( function($path)
{
    // Split our path at /
    $bits = explode('/', $path);
 
    array_unshift($bits, "user");
    // Default the resource to the first part, and if it's empty, default to index
    $resource = ucfirst(array_shift($bits));
    if (!$resource) $resource = "index";
 
    // Actual path to the resource
    $path = app_path() . '/controllers/' . $resource;
        
    // If no action, default to index
    $action = array_shift($bits);
    if (!$action) {
        $action = 'index';
    }
    
    // Namespace
    $namespace = array($resource);
 
    // If the path is a directory, then we keep looking deeper
    while (is_dir($path)) {
        // Add the current part to the namespace array
        $namespace[] = ucfirst($action);
        // Add to the path
        $path .= "/".ucfirst($action);
        
        // If nothing left, default to index
        if (empty($bits)) {
            break;
        }
        // Get rid of the first key in our array
        $action = array_shift($bits);
    }
 
    // Controller should always start with an upper case letter
    $lastIndex = count($namespace) - 1;
    $namespace[$lastIndex] = ucfirst($namespace[$lastIndex]);
    $resource = implode("\\", $namespace);
    
    // If what we have stored in $action is numeric, then it's not a method, default to index
    if (is_numeric($action) || (strpos($action, ',') !== FALSE) ) {
        if(count($bits) > 0){
            if($bits[0] == 'edit'){
                $bits[0] = $action;
                $action = 'edit';
            } 
        } else {            
            array_unshift($bits, $action);
        }
    }
   
    if($action != 'edit'){
        switch (Request::method()){                
            case 'POST'     : $action = 'store'; break;
            case 'PUT'      : $action = 'update'; break;
            case 'PATCH'    : $action = 'patch'; break;
            case 'DELETE'   : $action = 'destroy'; break;
            default         : 
                if(!empty($bits)){
                    $action = 'show';
                } else {
                    $action = 'index';
                }
                break;
        }
    }
    
    // Controllers names should always end with Controller
    $controller = app()->make($resource."Controller");
        
    // Call our controller method with our request type as a prefix
    return $controller->callAction($action,$bits);//strtolower(Request::method()) . "_" .
}))->where(array(
    'path' => '(.*)?'
));

Route::any('rlang/{path?}',  function($path)
{
    $bits = explode('/', $path);
    foreach ($bits as $key => $value) {
        $ucpath[] = ucfirst($value);
    }

    $ucpath = implode('/', $ucpath);
    
    $lang = array();

    App::setLocale(Session::get('lang'));

    if (Lang::has($ucpath))
    {
        $lang["titleRoot"] = Lang::get($ucpath.".titleRoot");
        $lang["columnRoot"] = Lang::get($ucpath.".columnRoot");
    }
    
    return Response::json($lang);

})->where(array(
    'path' => '(.*)?'
));

Route::post('user/master/investmentobjective', array('uses' => 'User\Master\InvestmentobjectiveController'));


Route::get('upload/{fname}', function($fname)
{
    $filepath = base_path() . '/upload/' . $fname;
    
    $mime = 'image/jpeg';
    $size = filesize($filepath);
    $file = file_get_contents($filepath);
     
    $headers = [
        'Content-Type' => $mime,
        'Content-Length' => $size
    ];
     
    return Response::make( $file, 200, $headers );


});


Route::any('/getSession', function()
{
    $a=Session::get('userNameAdmin');
    if(empty($a)){
        Session::put('userNameAdmin','');
    }
    return Session::all();
});

 Route::any('/getCaptcha', function()
    {


        if(Session::get('chaptSession')==1){
            $rest['data']['url']=Captcha::url();
            $rest['data']['active']=1;
            $rest['status']['error']    =0;
            $rest['status']['errorCode']=0;
            $rest['status']['message']  ='no error';
        }else{
            $rest['data']['url']='';
            $rest['data']['active']=0;
            $rest['status']['error']    =0;
            $rest['status']['errorCode']=0;
            $rest['status']['message']  ='no error';
        }
        return $rest;
    
});

 Route::any('/getCaptchaForgetPass', function()
    {
        $rest['data']['url']=Captcha::url();
        $rest['data']['active']=1;
        $rest['status']['error']    =0;
        $rest['status']['errorCode']=0;
        $rest['status']['message']  ='no error';
        return $rest;
    
});

Route::post('admin/resetpassadmin'  , array('uses' => 'Admin\Config\ChangepasswordController@store'));
Route::post('user/resetpass'        , array('uses' => 'User\Config\ChangepasswordController@store'));



Route::get('setPage/{urlpage}', function($urlpage)
{
    Session::put('page',$urlpage);
    $rest['status']['error']    =0;
    $rest['status']['errorCode']=0;
    $rest['status']['message']  ='no error';
    return $rest;    
});

Route::get('getPage', function()
{

    if(!Session::has('page'))
        $rest['data']['page']='login';
    else{
        $rest['data']['page']=Session::get('page');
    }    
    $rest['status']['error']    =0;
    $rest['status']['errorCode']=0;
    $rest['status']['message']  ='no error';
    return $rest;
    
});


//API WEBSERVICE

Route::get('service/antrean/status/{poli}/{tglperiksa}', 'Service\AntrianController@getdata');
Route::get('service/antrean/sisapeserta/{nokartu_jkn}/{poli}/{tglperiksa}', 'Service\SisaantrianController@getdata');
Route::get('service/antrean/jadwalpoli/{poli}/{tglperiksa}', 'Service\JadwalpoliController@getdata');
Route::post('service/peserta', 'Service\PesertaController@postdata');
Route::post('service/antrean', 'Service\InsertantrianController@postdata');
Route::delete('service/antrean/batal', 'Service\BatalantrianController@deletedata');
