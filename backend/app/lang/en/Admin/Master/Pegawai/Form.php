<?php
/*
 * Langguage mapping for Role
 */

return array( 
       "form"=>array(
                    array(
                            'id'    => 'pegId',
                            'name'  => 'ID',
                            'type'  => 'hidden',
                            'readonly'  => '1',
                        ),
                    array(
                            'id'    => 'pegNip',
                            'name'  => 'NIP',
                            'type'  => 'text',
                            'readonly'  => '1',
                        ),
                     array(
                            'id'    => 'pegNik',
                            'name'  => 'NIK',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                       array(
                            'id'    => 'pegKta',
                            'name'  => 'KTA',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'pegNama',
                            'name'  => 'NAMA',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'pegJk',
                            'name'  => 'JENIS KELAMIN',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'pegTempatLahir',
                            'name'  => 'TEMPAT LAHIR',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'pegTglLahir',
                            'name'  => 'TANGGAL LAHIR',
                            'type'  => 'date',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'pegTlp',
                            'name'  => 'No.Telp',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ), array(
                            'id'    => 'pegEmail',
                            'name'  => 'Email',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                  
                 
                   
                  
                    array(
                            'id'    => 'pegUnit',
                            'name'  => 'Unit',
                            'type'  => 'autocomplete',
                            'comboapi' => 'backend/public/api/admin/master/unitforcombo',
                            'readonly'  => '0',
                        ),
                     array(
                            'id'    => 'pegJab',
                            'name'  => 'Jabatan',
                            'type'  => 'autocomplete',
                            'comboapi' => 'backend/public/api/admin/master/jabatanforcombo',
                            'readonly'  => '0',
                        ),
                
                    // array(
                    //         'id'    => 'pegInstansi',
                    //         'name'  => 'Instansi',
                    //         'type'  => 'autocomplete',
                    //         'comboapi' => 'backend/public/api/admin/master/skpdforcombo',
                    //         'readonly'  => '0',
                    //     ),
                )
);
