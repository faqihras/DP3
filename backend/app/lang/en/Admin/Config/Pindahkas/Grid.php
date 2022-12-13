<?php
/*
 * Langguage mapping for Role
 */
$data['kolom']= array(
                     array(
                           "title"=>"ID", 
                           "data"=>"kasId",
                           ),
                     array(
                           "title"=>"TANGGAL", 
                           "data"=>"kasTglTrans",
                           "width"=>"12%",
                           ),
                     array(
                           "title"=>"REKENING ASAL", 
                           "data"=>"kasRekAsal",
                           ),
                     array(
                           "title"=>"REKENING TUJUAN", 
                           "data"=>"kasRekTujuan",
                           ),
                     array(
                           "title"=>"NILAI", 
                           "data"=>"kasPindah2",
                           "sClass"=>"number",
                           "width"=>"15%",
                           ),
                );


return $data;