<?php
namespace Admin\Config;


use DetailController;
use DB;
use Input;

class RoleDetaildataController extends DetailController {
    /**
    * Set Model's Repository
    * Set Validatior object
    */
    public function __construct() {
        $this->model = new RoleDetail();
    }    
    
    public function index(){
      
      $param=Input::all();

       try {
            $query = DB::table($this->model->getTable())
                    ->select('rolmId','rolmRoleId','rolmMenuId')
                    ->where('rolmRoleId','=',$param['roleId']);
            
           return $this->getDataGrid($query);                
       }catch(Exception $e){
           return Response::exception($e);
       }    
    }     

    public function store(){

           $param=Input::all();
           $query = DB::table('menu')
                  ->select('menuId')
                  ->get();

           DB::table('role_menu')->where('rolmRoleId', '=', $param['roleMenuId'])->delete();         
           foreach ($query as $key => $value) {
              $field =$value->menuId;
              if($param[$field]!='xxx'){

                  DB::table('role_menu')->insert(
                      array('rolmRoleId' => $param['roleMenuId'], 'rolmMenuId' => $field)
                  );
              }
           }
           return $param;
    }

}