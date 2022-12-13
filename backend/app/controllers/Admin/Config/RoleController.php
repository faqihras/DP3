<?php
namespace Admin\Config;

use DB;
use Response;
use Lang;

class RoleController extends \BasicController {
    /**
    * Set Model's Repository
    * Set Validatior object
    */
    public function __construct() {
        $this->model = new Role();
        //$this->detail = new RoleDetailController();
    }
     
     
    /**
    * Display a listing of the resource.
    * The default list is undeleted list
    * GET /admin/master/base
    *
    * @return Response
    */
    public function index()
    {
       try {
            $query = DB::table($this->model->getTable())
                    ->select('roleId', 'roleName')
                    // ->where('roleStatus','=','2')
                    ->orderBy('roleId','desc');                     
          return $this->getDataGrid($query); 
          //$queries = DB::getQueryLog();
          //print_r($queries);      
       }catch(Exception $e){
           return Response::exception($e);
       }    
    }

}