<?php
namespace Admin\Config;

use DB;
use Response;
use Lang;
use Auth;
use Input;

class ModulController extends  \BasicController {
    /**
     * Set Model's Repository
     */

     public function index(){
          $data = array(
                         array(
                               "id"=>"1", 
                               "kode"=>"1",
                               "nama"=>"PPKD"
                               ),
                         array(
                               "id"=>"2", 
                               "kode"=>"2",
                               "nama"=>"SKPD"
                               ),
                      );

          return $data;

     }
}