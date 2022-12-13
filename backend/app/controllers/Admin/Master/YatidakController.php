<?php
namespace Admin\Master;

class YatidakController extends  \BasicController {
    /**
     * Set Model's Repository
     */

     public function index(){
          $data = array(
                         array(
                               "id"=>"1",
                               "kode"=>"1",
                               "nama"=>"Ya",
                               "text"=>"Ya",
                               ),
                         array(
                               "id"=>"0",
                               "kode"=>"0",
                               "nama"=>"Tidak",
                               "text"=>"Tidak",
                               ),
                         );
          return $data;

     }
}
