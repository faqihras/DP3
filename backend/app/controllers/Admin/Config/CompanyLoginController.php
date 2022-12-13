<?php
namespace Admin\Config;

use BasicController;
use DB;
use Session;
use Response;
use Input;

class CompanyLoginController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Company();
     }
     
     /**
      * get all company's user
      */
     public function index() {
        if(Session::has('companyId')){
            return Response::message(135);
        }
         
        $result = array();
        $result['data'] = DB::table('company')
                ->leftJoin('user_company','uscoCompId','=','compId')
                ->where('uscoUserId','=',Session::get('tempUserId'))
                ->get();
        
        return Response::json($result); 
     }
     
     /**
      * save company id as session
      */
     public function store() {
        if(Session::has('companyId')){
            return Response::message(135);
        }
         
        // validate company Id with user Id
        $comp = (array) DB::table('company')
                ->leftJoin('user_company','uscoCompId','=','compId')
                ->where('uscoUserId','=',Session::get('tempUserId'))
                ->where('uscoCompId','=',Input::get('compId'))
                ->first();
        
        if(empty($comp)){
            return Response::message(113);
        }
         
        // save into session
        Session::put('companyId', $comp['compId']);
        Session::put('companyName', $comp['compName']);
        Session::put('companyList', 0);
        
        $result = Response::message(6);
        $result['data'] = array(
            'userFirstLogin' => Session::get('userFirstLogin'),
            'companyList' => 0
        );

        return $result;
     }
}