<?php
namespace Admin\Config\Roleapi;

use TreeMenuController;
use DB;
use Response;

class MenuController extends TreeMenuController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new \Admin\Config\Menu();
     }

   /**
    * Display a listing of the resource.
    * The default list is undeleted list
    *
    * @return Response
    */
     public function index()
     {
         $user_access = DB::table('menu')
                    ->select('menuId','menuName','menuParentId','menuOrder')
                    ->where('menuNonActive','=','0')
                    ->orderBy('menuLevel', 'asc')
                    ->orderBy('menuParentId', 'asc')
                    ->orderBy('menuOrder', 'asc')
                   ->get();
//                    ->where('menuScope','=','1')
         return $this->getMenuResponse($user_access);
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
            'menuId'            => $v['menuId'],
            'menuName'          => $v['menuName'],
            'menuParentId'      => $v['menuParentId'],
            'menuOrder'         => $v['menuOrder'],
            'data'              => $menu
        );
    }
}
