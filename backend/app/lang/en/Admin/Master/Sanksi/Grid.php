<?php
/*
 * Langguage mapping for Role
 */
$data['kolom']= array(
                     array(
                           "title"=>"ID", 
                           "data"=>"sankId",
                           "width" => "3%",
                           ),
                     array(
                           "title"=>"NAMA SANKSI", 
                           "data"=>"sankNama",
                           ),
                     array(
                           "title"=>"PERSEN", 
                           "data"=>"sankPersen",
                           "width" => "15%",
                           "sClass" => 'number',
                           ),
                     array(
                           "title"=>"JENIS", 
                           "data"=>"sankJenis",
                           "width" => "15%",
                           ),
                );


return $data;