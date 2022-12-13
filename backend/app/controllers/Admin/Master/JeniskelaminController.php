<?php
namespace Admin\Master;

class JeniskelaminController extends  \BasicController {
    /**
     * Set Model's Repository
     */

     public function index(){
          $data = array(
                         array(
                               "id"=>"l",
                               "kode"=>"l",
                               "nama"=>"Laki - Laki",
                               "text"=>"Laki - Laki",
                               ),
                         array(
                               "id"=>"p",
                               "kode"=>"p",
                               "nama"=>"Perempuan",
                               "text"=>"Perempuan",
                               ),
                         );
          return $data;

     }
}
