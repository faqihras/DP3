<?php
/*
 * Langguage mapping for Role
 */

return array( 
       "form"=>array(
                    array(
                            'id'    => 'adrkaId',
                            'name'  => 'ID',
                            'type'  => 'hidden',
                            'readonly'  => '1',
                        ),
                    array(
                            'id'    => 'adrkaRek5Kd',
                            'name'  => 'KODE REKENING',
                            'type'  => 'text',
                            'readonly'  => '1',
                        ),
                    array(
                            'id'    => 'adrkaRek5Nm',
                            'name'  => 'NAMA REKENING',
                            'type'  => 'text',
                            'readonly'  => '1',
                        ),
                    array(
                            'id'    => 'adrkaNilai',
                            'name'  => 'NILAI ANGGARAN',
                            'type'  => 'angka',
                            'readonly'  => '0',
                        ),
  
                    array(
                            'id'    => 'adrkaSbrDana1',
                            'name'  => 'SUMBER DANA 1',
                            'type'  => 'combo',
                            'comboapi'  => 'backend/public/api/admin/master/sumberdanaforcombo',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'adrkaSbrDana2',
                            'name'  => 'SUMBER DANA 2',
                            'type'  => 'combo',
                            'comboapi'  => 'backend/public/api/admin/master/sumberdanaforcombo',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'adrkaSbrDana3',
                            'name'  => 'SUMBER DANA 3',
                            'type'  => 'combo',
                            'comboapi'  => 'backend/public/api/admin/master/sumberdanaforcombo',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'adrkaSbrDana4',
                            'name'  => 'SUMBER DANA 4',
                            'type'  => 'combo',
                            'comboapi'  => 'backend/public/api/admin/master/sumberdanaforcombo',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'adrkaSbrDana5',
                            'name'  => 'SUMBER DANA 5',
                            'type'  => 'combo',
                            'comboapi'  => 'backend/public/api/admin/master/sumberdanaforcombo',
                            'readonly'  => '0',
                        ),

                )
);
