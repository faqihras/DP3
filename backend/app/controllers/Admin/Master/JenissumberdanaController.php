<?php
namespace Admin\Master;


class JenissumberdanaController extends  \BasicController {
    /**
     * Set Model's Repository
     */

     public function index(){


              $data[]=array(
                               "id"=>'0', 
                               "kode"=>'0',
                               "nama"=>'KESELURUHAN',
                               "text"=>'KESELURUHAN',
                            );
              $data[]=array(
                               "id"=>'1', 
                               "kode"=>'1',
                               "nama"=>'APBD',
                               "text"=>'APBD',
                            );
              $data[]=array(
                               "id"=>'2', 
                               "kode"=>'2',
                               "nama"=>'BLUD',
                               "text"=>'BLUD',
                            );

          return $data;

     }
}