<?php
namespace Admin\Tool;

use BasicController;
use DB;
use Lang;
use Input;

class HapuspotdobelController extends BasicController {
     public function index(){
        return DB::select('call Hapuspotdouble()');     	 
     }


}