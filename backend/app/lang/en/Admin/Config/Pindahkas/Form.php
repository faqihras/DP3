<?php
/*
 * Langguage mapping for Role
 */

return array( 
       "form"=>array(
                    array(
                            'id'    => 'kasId',
                            'name'  => 'ID',
                            'type'  => 'hidden',
                            'readonly'  => '1',
                        ),
                    array(
                            'id'    => 'kasNoTrans',
                            'name'  => 'NOMOR TRANSAKSI',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'kasTglTrans',
                            'name'  => 'TANGGAL',
                            'type'  => 'date',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'kasRekAsal',
                            'name'  => 'KAS ASAL',
                            'type'  => 'combo',
                            'comboapi'  => 'backend/public/api/admin/master/bankforcombo',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'kasSaldoAsal',
                            'name'  => 'SALDO KAS ASAL',
                            'type'  => 'angka',
                            'readonly'  => '1',
                        ),


                    array(
                            'id'    => 'kasRekTujuan',
                            'name'  => 'KAS TUJUAN',
                            'type'  => 'combo',
                            'comboapi'  => 'backend/public/api/admin/master/bankforcombo',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'kasPindah',
                            'name'  => 'JUMLAH YANG DIPINDAH',
                            'type'  => 'angka',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'kasSaldoTujuan',
                            'name'  => 'SALDO KAS TUJUAN',
                            'type'  => 'angka',
                            'readonly'  => '1',
                        ),

                )
);
