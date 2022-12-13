<?php
namespace Admin\Config;

use DB;
use Response;
use Lang;
use Auth;
use Input;

class MenuadminapiController extends \BasicController {

     public function __construct() {
         $this->model = new Menu();
     }

     public function index(){

       $param=Input::all();        
       $search=$param['search']['value'];

       try {
            $query = DB::table($this->model->getTable())
                    ->select('*', 
                    DB::raw('(CASE WHEN menuScope = 1 THEN "PPKD" ELSE "SKPD" END) AS nmModul'),
                    DB::raw('(select x.menuName from menu x where x.menuId='.$this->model->getTable().'.menuParentId) AS nmParent')

                    )
                    ->where('menuName','like','%'.$search.'%');
            
           return $this->getDataGrid($query);                
       }catch(Exception $e){
           return Response::exception($e);
       }    

     }

}
