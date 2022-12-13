<?php
/*
 * Langguage mapping for Role
 */
$data['kolom']= array(
                     array(
                           "title"=>"ID", 
                           "data"=>"kecId",
                           "width" => "3%",
                           ),
                     array(
                           "title"=>"PROVINSI", 
                           "data"=>"provNama",
                           ),
                     array(
                           "title"=>"KABUPATEN/KOTA", 
                           "data"=>"kabNama",
                           "width" => "30%",
                           ),
                     array(
                           "title"=>"KECAMATAN", 
                           "data"=>"kecNama",
                           "width" => "30%",
                           ),
                );


return $data;