<?php
/**
 * Report base controller 
 * 
 */
namespace Agape\Controller;

use View;
use Lang;
use \Agape\Auth\Permission as Permit;

class ReportController extends BasicController {
    
    function getPermit($menuLink) {
        $role = new \Agape\Auth\Role();
        $validRole = $role->authentication();
        if($validRole == 20){
            if(Permit::view($menuLink) == '1'){
               return true; 
            }
        }
        return false; 
    }
    
    public function index() {
        return $this->error();
    }
    
    public function show($id) {
        return $this->error();
    }
    
    public function update($id) {
       return $this->error(); 
    }
    
    public function delete($id) {
        return $this->error();
    }
    
    private function error() {
        return View::make('view.admin.error')->with('alert', Lang::get('access_denied'));
    }
}