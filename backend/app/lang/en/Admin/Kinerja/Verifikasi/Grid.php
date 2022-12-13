<?php
/*
 * Langguage mapping for Role
 */
$data['kolom']= array(
     array(
                           "title"=>"NAMA PEGAWAI",
                           "data"=>"pegNama",
                           "width" => "8%",
                           "align" => "",
                           "rowspan"=>0,
                           "colspan"=>0,
                           ),
                  
                     array(
                           "title"=>"SKP TAHUNAN",
                           "data"=>"lkSkpTahun",
                           "width" => "8%",
                           "align" => "",
                           "rowspan"=>0,
                           "colspan"=>0,
                           ),
                     // array(
                     //       "title"=>"ATASAN",
                     //       "data"=>"lkAtasan",
                     //       "width" => "9%",
                     //       "align" => "center",
                     //       "rowspan"=>0,
                     //       "colspan"=>0,
                     //       ),
                     array(
                           "title"=>"JENIS KEGIATAN",
                           "data"=>"akNamaKegiatan",
                           "width" => "25%",
                           "align" => "center",
                           "rowspan"=>0,
                           "colspan"=>0,
                           ),
                      array(
                           "title"=>"KETERANGAN",
                           "data"=>"lkKeterangan",
                           "width" => "25%",
                           "align" => "center",
                           "rowspan"=>0,
                           "colspan"=>0,
                           ),
                     
                     array(
                           "title"=>"STATUS", 
                           "data"=>"lkStatus",
                           "width" => "6%",
                           "align" => "center",
                           "sClass" => "center",
                           "rowspan"=>0,
                           "colspan"=>0,
                           ),
                      array(
                           "title"=>"VERIFIKASI", 
                           "data"=>"detail",
                           "width" => "3%",
                           "align" => "center",
                           "sClass" => "center",
                           "rowspan"=>0,
                           "colspan"=>0,
                           ),
                );


return $data;
