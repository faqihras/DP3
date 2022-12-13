<?php
namespace Admin\Master;


class SemesterController extends  \BasicController {
    /**
     * Set Model's Repository
     */

     public function index(){
          $data = array(
                      array(
                               "id"=>"1", 
                               "kode"=>"1",
                               "nama"=>"Ganjil (Juli-Desember)",
                               "text"=>"Ganjil (Juli-Desember)"
                               ),
                        array(
                               "id"=>"2", 
                               "kode"=>"2",
                               "nama"=>"Genap (Januari-Juni)",
                               "text"=>"Genap (Januari-Juni)"
                               ),
                        // array(
                        //        "id"=>"3", 
                        //        "kode"=>"3",
                        //        "nama"=>"Maret",
                        //        "text"=>"Maret"
                        //        ),
                        // array(
                        //        "id"=>"4", 
                        //        "kode"=>"4",
                        //        "nama"=>"April",
                        //        "text"=>"April"
                        //        ),
                        // array(
                        //        "id"=>"5", 
                        //        "kode"=>"5",
                        //        "nama"=>"Mei",
                        //        "text"=>"Mei"
                        //        ),
                        // array(
                        //        "id"=>"6", 
                        //        "kode"=>"6",
                        //        "nama"=>"Juni",
                        //        "text"=>"Juni"
                        //        ),
                        // array(
                        //        "id"=>"7", 
                        //        "kode"=>"7",
                        //        "nama"=>"Juli",
                        //        "text"=>"Juli"
                        //        ),
                        //  array(
                        //        "id"=>"8", 
                        //        "kode"=>"8",
                        //        "nama"=>"Agustus",
                        //        "text"=>"Agustus"
                        //        ),
                        //   array(
                        //        "id"=>"9", 
                        //        "kode"=>"9",
                        //        "nama"=>"September",
                        //        "text"=>"September"
                        //        ),
                        //    array(
                        //        "id"=>"10", 
                        //        "kode"=>"10",
                        //        "nama"=>"Oktober",
                        //        "text"=>"Oktober"
                        //        ),
                        //     array(
                        //        "id"=>"11", 
                        //        "kode"=>"11",
                        //        "nama"=>"November",
                        //        "text"=>"November"
                        //        ),
                        //      array(
                        //        "id"=>"12", 
                        //        "kode"=>"12",
                        //        "nama"=>"Desember",
                        //        "text"=>"Desember"
                        //        ),
                      );

          return $data;

     }
}