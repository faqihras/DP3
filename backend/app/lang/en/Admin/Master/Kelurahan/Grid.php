<?php
/*
 * Langguage mapping for Role
 */
$data['kolom']= array(
                     array(
                           "title"=>"ID", 
                           "data"=>"kelId",
                           "width" => "3%",
                           ),
                     array(
                           "title"=>"PROVINSI", 
                           "data"=>"provNama",
                           ),
                     array(
                           "title"=>"KABUPATEN/KOTA", 
                           "data"=>"kabNama",
                           "width" => "25%",
                           ),
                     array(
                           "title"=>"KECAMATAN", 
                           "data"=>"kecNama",
                           "width" => "25%",
                           ),
                     array(
                           "title"=>"DESA/KELURAHAN", 
                           "data"=>"kelNama",
                           "width" => "25%",
                           ),
                );


return $data;