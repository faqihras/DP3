<?php
namespace Admin\Config;

use TreeMenuController;
use DB;
use Response;
use Session;

class DashboardController extends TreeMenuController {
    /**
    * Display a listing of the resource.
    * GET /menu
    *
    * @return Response
    */
   public function index()
   {
        if(Session::get('userRolhIdAdmin')){
        $menu = array();
        $role = new \Agape\Auth\Role();
        $validRole = $role->authentication();
        if($validRole == 20){
            $data = DB::table('role_menu')
                ->join('menu', 'rolmMenuId', '=', 'menuId')
                ->where('menuNonActive', '=', '0')
                ->where('rolmRoleId', '=', Session::get('userRolhIdAdmin'))
                ->where('rolmView', '=', '1')
                ->where('menuScope', '1')
                ->orderBy('menuParentId', 'asc')
                ->orderBy('menuOrder', 'asc')
                ->orderBy('menuName', 'asc')
                ->get();
            
            $menu = $this->generateTree(0, $data);
        }

        $data = Session::all();
        //print_r($data);

        $queries = DB::getQueryLog();
        $last_query = end($queries);
        
        $result = Response::message($validRole);
        $result["menu"] = $menu;
        $result["rightmenu"] = $this->getRightMenu();

       return $result;
     }
   }
   
   /**
    * Menu default format
    * 
    * @param array $v row query result 
    * @param array $menu child menu
    * @param array $arrData array menu 
    */
   protected function getMenu($v, $menu, &$arrData){  
       $arrData[] = array(
           'id'                => $v['menuId'],
           'name'              => $v['menuName'],
           'menuName'          => $v['menuName'],
           'link'              => $v['menuLink'],
           'apiPath'           => $v['menuAPI'],
           'parent'            => $v['menuParentId'],
           'order'             => $v['menuOrder'],
           'modal'             => '',
           'menu'              => $menu
       );
   }
   
   /**
    * Get menu api url base on menuLink
    * 
    * @param string $id menuLink
    * @return type
    */
   protected function getShowData($id) {
       $data = (array) DB::table('role_menu')
               ->join('menu', 'rolmMenuId', '=', 'menuId')
               ->where('menuNonActive', '=', '0')
               ->where('rolmRoleId', '=', Session::get('userRolhIdAdmin'))
               ->where('rolmView', '=', '1')
               ->where ('menuLink','=', $id)
               ->first();
       
       return $data;
   }
}