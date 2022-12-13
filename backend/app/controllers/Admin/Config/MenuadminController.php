<?php
namespace Admin\Config;

use TreeMenuController;
use DB;
use Response;
use Lang;
use Auth;
use \Agape\Auth\Permission as Permit;
use Input;
use Session;

class MenuadminController extends TreeMenuController {

     public function __construct() {
         $this->model = new Menu();
     }

    public function index()
    {
        $ses  =Session::all();

        $data = DB::table('menu')
                    ->select('menuId','menuName','menuModal','htmlLink','menuIcon','menuLink','menuParentId','menuOrder')
                    ->join('role_menu','menuId','=','rolmMenuId')
                    ->where('menuScope', '1')
                    ->where('rolmRoleId','=',$ses['userRolhId'])
                    ->orderBy('menuOrder', 'asc')
                    ->orderBy('menuNonActive', 'asc')
                    ->orderBy('menuParentId', 'asc')
                    ->orderBy('menuName', 'asc')
                    ->get();
 

        $total = (array) DB::table('menu')
                    ->select(DB::raw('count(*) as total'))
                    ->where('menuDeletedUserId')
                    ->first();
                
        $result = array(
                //"permission" => Permit::all(null),
                "data" => $this->generateTree(0, $data),
                "pagination" => array(
                        'page'          => 1,
                        'itemPerPage'   => $total['total'],
                        'totalPage'     => 1,
                        'total'         => $total['total']
                )
        );

        return Response::json($result);
    }


    protected function getMenu($v, $menu, &$arrData){ 
        $arrData[] = array(
            'menuId'            => $v['menuId'],
            'menuName'          => $v['menuName'],
            'htmlLink'          => $v['htmlLink'],  
            'menuModal'         => $v['menuModal'],
            'menuLink'          => $v['menuLink'],
            'menuParentId'      => $v['menuParentId'],
            'menuOrder'         => $v['menuOrder'],
            'menuIcon'         => $v['menuIcon'],
            //'menuNonActiveDescription' => $v['menuNonActiveDescription'],
            'data'              => $menu
        );
    }
}
