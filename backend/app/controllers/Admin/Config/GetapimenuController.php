<?php
namespace Admin\Config;

use DB;
use Response;
use Lang;
use Auth;
use Input;

class GetapimenuController extends \BasicController {

     public function __construct() {
         $this->model = new Menu();
     }

    public function index()
    {

        $data = DB::table('menu')
                    ->select('apiLangGrid','apiLangForm','apiData')
                    ->where('menuLink','=',Input::get('modul'))
                    ->orderBy('menuOrder', 'asc')
                    ->orderBy('menuNonActive', 'asc')
                    ->orderBy('menuParentId', 'asc')
                    ->orderBy('menuName', 'asc')
                    ->get();
         

        return $data;
    }

}
