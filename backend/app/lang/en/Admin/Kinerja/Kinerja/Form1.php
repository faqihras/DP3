<?php
/*
 * Langguage mapping for Role
 */

return array( 
       "form"=>array(
                    // array(
                    //         'id'    => 'lkId',
                    //         'name'  => 'ID',
                    //         'type'  => 'hidden',
                    //         'readonly'  => '1',
                    //     ),
                    // array(
                    //         'id'    => 'lkIdPeg',
                    //         'name'  => 'ID',
                    //         'type'  => 'hidden',
                    //         'readonly'  => '1',
                    //     ),
                    // array(
                    //         'id'    => 'lkTglAwal',
                    //         'name'  => 'TANGGAL AWAL',
                    //         'type'  => 'date',
                    //         'readonly'  => '0',
                    //     ),
                     array(
                            'id'    => 'pegawai',
                            'name'  => 'NAMA PEGAWAI',
                            'type'  => 'combo',
                            'comboapi'  => 'backend/public/api/admin/master/pegawai2forcombo',
                            'readonly'  => '1',
                            "row" => '2',
                        ),
                    array(
                            'id'    => 'skp',
                            'name'  => 'SKP TAHUNAN',
                            'type'  => 'text',
                            'readonly'  => '1',
                            "row" => '2',
                        ),
                    array(
                            'id'    => 'atasan',
                            'name'  => 'NAMA ATASAN',
                            'type'  => 'text',
                            'readonly'  => '1',
                            "row" => '2',
                        ),
                    
                    array(
                            'id'    => 'kegiatan',
                            'name'  => 'JENIS KEGIATAN',
                            'type'  => 'combo',
                            'comboapi'  => 'backend/public/api/admin/master/angkakreditforcombo',
                            'readonly'  => '1',
                            "row" => '2',
                             
                        ),
                    array(
                            'id'    => 'kredit',
                            'name'  => 'ANGKA KREDIT',
                            'type'  => 'text',
                            'readonly'  => '1',
                            "row" => '2',
                        ),
                    array(
                            'id'    => 'target',
                            'name'  => 'TARGET WAKTU',
                            'type'  => 'text',
                            'readonly'  => '1',
                            "row" => '2',
                        ),
                    array(
                            'id'    => 'biaya',
                            'name'  => 'BIAYA',
                            'type'  => 'text',
                            'readonly'  => '1',
                            "row" => '2',
                        ),
                      array(
                            'id'    => 'status',
                            'name'  => 'STATUS',
                            'type'  => 'combo',
                            'comboapi'  => 'backend/public/api/admin/kinerja/approvalcombo',
                            'readonly'  => '1',
                            "row" => '2',
                        ),
                            
                    array(
                            'id'    => 'keterangan',
                            'name'  => 'KETERANGAN',
                            'type'  => 'textarea',
                            'readonly'  => '1',
                            "row" => '2',
                        ),

                   

                )
);
