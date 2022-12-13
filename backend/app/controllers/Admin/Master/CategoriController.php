<?php
namespace Admin\Master;


class CategoriController extends  \BasicController {
    /**
     * Set Model's Repository
     */

     public function index(){
          $data = array(
                      array(
                               "id"=>"1", 
                               "kode"=>"1",
                               "nama"=>" Jadwal KBM",
                               "text"=>" Jadwal KBM"
                               ),
                        array(
                               "id"=>"2", 
                               "kode"=>"2",
                               "nama"=>" Kalender Akademik",
                               "text"=>" Kalender Akademik"
                               ),
                        array(
                               "id"=>"3", 
                               "kode"=>"3",
                               "nama"=>" Pekan Efektif",
                               "text"=>" Pekan Efektif"
                               ),
                        array(
                               "id"=>"4", 
                               "kode"=>"4",
                                "nama"=>" Analisa KKM",
                               "text"=>" Analisa KKM"
                               ),
                        array(
                               "id"=>"5", 
                               "kode"=>"5",
                                "nama"=>" Distibusi Materi",
                               "text"=>" Distibusi Materi"
                               ),
                         array(
                               "id"=>"6", 
                               "kode"=>"6",
                                "nama"=>" Analisis Materi",
                               "text"=>" Analisis Materi"
                               ),
                       
                      );

          return $data;

     }
}