<?php
/*
 * Langguage mapping for Role
 */
$data['kolom']= array(
                     array(
                           "title"=>"ID", 
                           "data"=>"adrkaId",
                           "width" => "10%",
                           ),
                     array(
                           "title"=>"KODE", 
                           "data"=>"adrkaRek5Kd",
                           "width" => "15%",
                           "sClass"=> "center",
                           ),
                     array(
                           "title"=>"NAMA REKENING", 
                           "data"=>"adrkaRek5Nm",
                           "width" => "55%",
                           ),
                     array(
                           "title"=>"NILAI", 
                           "data"=>"adrkaNilai",
                           "width" => "20%",
                           "sClass"=> "number",
                           ),
                );


return $data;