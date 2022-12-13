<?php
namespace Admin\Master;


class Indikator3Controller extends  \BasicController {
    /**
     * Set Model's Repository
     */

     public function index(){
          $data = array(
                      array(
                               "id"=>"1", 
                               "kode"=>"1",
                               "nama"=>" Seluruh Indikator Terpenuhi",
                               "text"=>" Seluruh Indikator Terpenuhi"
                               ),
                        array(
                               "id"=>"2", 
                               "kode"=>"2",
                               "nama"=>" Indikator Terpenuhi 10 Item",
                               "text"=>" Indikator Terpenuhi 10 Item"
                               ),
                        array(
                               "id"=>"3", 
                               "kode"=>"3",
                               "nama"=>" Indikator Terpenuhi 8 Item",
                               "text"=>" Indikator Terpenuhi 8 Item"
                               ),
                        array(
                               "id"=>"4", 
                               "kode"=>"4",
                                "nama"=>" Indikator Terpenuhi 6 Item",
                               "text"=>" Indikator Terpenuhi 6 Item"
                               ),
                        array(
                               "id"=>"5", 
                               "kode"=>"5",
                                "nama"=>" Tidak Satupun Indikator Terpenuhi",
                               "text"=>" Tidak Satupun Indikator Terpenuhi"
                               ),
                       
                      );

          return $data;

     }
}