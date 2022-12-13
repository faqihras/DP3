<?php
namespace Admin\Master;

class KawinforcomboController extends  \BasicController {
    /**
     * Set Model's Repository
     */

     public function index(){
          $data = array(
                         array(
                               "id"=>"Kawin",
                               "kode"=>"Kawin",
                               "nama"=>"Kawin",
                               "text"=>"Kawin",
                               ),
                         array(
                               "id"=>"Tidak Kawin",
                               "kode"=>"Tidak Kawin",
                               "nama"=>"Tidak Kawin",
                               "text"=>"Tidak Kawin",
                               ),
                         array(
                               "id"=>"Duda",
                               "kode"=>"Duda",
                               "nama"=>"Duda",
                               "text"=>"Duda",
                               ),
                         array(
                               "id"=>"Janda",
                               "kode"=>"Janda",
                               "nama"=>"Janda",
                               "text"=>"Janda",
                               ),
                         );
          return $data;

     }
}
