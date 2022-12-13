<?php
/*
 * Langguage mapping for Role
 */
$data['kolom']= array(
                     array(
                           "title"=>"ID", 
                           "data"=>"akId",
                           "width" => "3%",
                           ),
                     array(
                           "title"=>"NAMA KEGIATAN", 
                           "data"=>"akNamaKegiatan",
                           ),
                     array(
                           "title"=>"SATUAN", 
                           "data"=>"akSatuanHasil",
                           "width" => "15%",
                           ),
                     array(
                           "title"=>"ANGKA KREDIT", 
                           "data"=>"AngkaKredit",
                           "width" => "15%",
                           "sClass" => 'number',
                           ),
                );


return $data;