<?php
namespace Admin\Config;

use DB;
use Response;
use Lang;
use Auth;
use Input;

class MenuadminforcomboController extends \BasicController {

     public function __construct() {
         $this->model = new Menu();
     }

     public function index(){


            $query = DB::table($this->model->getTable())
                    ->select('menuId as id','menuId as kode','menuName as nama')
                    ->orderby('menuName','ASC')
                    ->get();            
           return $query;                

     }

}
