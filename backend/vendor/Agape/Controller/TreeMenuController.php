<?php
namespace Agape\Controller;

use Response;
use BasicController;
use \Agape\Auth\Permission as Permit;

class TreeMenuController extends BasicController {

        /**
         * Return default response format 
         * 
         * @param array $user_access 
         * @return array result
         */
        protected function getMenuResponse($user_access) {
           $result = array(
                    "permission" => Permit::all($this->menuLink),
                    "data" => $this->generateTree(0, $user_access),
                    "pagination" => array(
                            'page'          => 1,
                            'itemPerPage'   => 0,
                            'totalPage'     => 1,
                            'total'         => 0
                        )
                );

            return Response::json($result);
        }
        
        /**
         * Generate tree menu
         * 
         * @param integer $parentId parent id
         * @param array $data query result
         * @return array tree result
         */
        protected function generateTree($parentId, $data) {
            $arrData = array();
            foreach($data as $k => $val){
                $val = (array) $val;
                if ($val['menuParentId'] == $parentId){
                    $menu = array();
                    if ($this->hasChildMenu($val['menuId'], $data)){                        
                        $menu = $this->generateTree($val['menuId'], $data);
                    }
                    $this->getMenu($val, $menu, $arrData);
                }
            }
            
            return $arrData;
	}
        
        /**
         * Check if menu has child menu
         * 
         * @param integer $menuId menu id
         * @param array $data query result
         * @return boolean 
         */
        protected function hasChildMenu($menuId, $data) {
            foreach($data as $k => $val){
                $val = (array) $val;
                if( $val['menuId'] == $menuId) {
                    return true;
                }
            }
            return false;
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
                //'apiPath'           => $v['menuAPI'],
                'parent'            => $v['menuParentId'],
                'order'             => $v['menuOrder'],
                'modal'             => '',
                'menu'              => $menu
            );
        }
        
        /**
         * Right menu contains: Change Password, Setting, Logout
         * 
         * @return array array menu 
         */
        protected function getRightMenu(){
            $v['menuId'] = 0;
            $v['menuLink'] = '';
            //$v['menuAPI'] = '';
            $v['menuParentId'] = 0;
            
            $v['menuName'] = '';       
            $v['adacView'] = 1;
            $v['adacNew'] = 1;
            $v['adacEdit'] = 1;
            $v['adacDelete'] = 1;
            $v['adacConfirm'] = 1;
            $v['adacVoid'] = 1;
            
            $arrData[] = array(
                'id'                => $v['menuId'],
                'menuName'          => 'Change Password',
                'name'              => 'Change Password',
                'link'              => $v['menuLink'],
                //'apiPath'           => $v['menuAPI'],
                'parent'            => $v['menuParentId'],
                'order'             => 1,
                'modal'             => 'password',
                'menu'              => ''
            );
            
            /*$arrData[] = array(
                'id'                => $v['menuId'],
                'menuName'          => 'Setting',
                'name'              => 'Setting',
                'link'              => $v['menuLink'],
                'apiPath'           => $v['menuAPI'],
                'parent'            => $v['menuParentId'],
                'order'             => 2,
                'modal'             => 'setting',
                'menu'              => ''
            );*/
            $arrData[] = array(
                'id'                => $v['menuId'],
                'menuName'          => 'Logout',
                'name'              => 'Logout',
                'link'              => 'logout',
                //'apiPath'           => $v['menuAPI'],
                'parent'            => $v['menuParentId'],
                'order'             => 3,
                'menu'              => ''
            );
            return $arrData;
        }  
}