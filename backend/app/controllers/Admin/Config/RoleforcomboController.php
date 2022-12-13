<?php
namespace Admin\Config;

use DB;
use Response;
use Lang;

class RoleforcomboController extends \BasicController {
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
                    ->select('roleId as id','roleId as kode', 'roleName as nama')                     
                    ->get();
          return $query; 
       }catch(Exception $e){
           return Response::exception($e);
       }    
    }

}