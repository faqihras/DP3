<?php
/*
 * Langguage mapping for Role
 */

return array( 
       "form"=>array(
                    array(
                            'id'    => 'lkId',
                            'name'  => 'ID',
                            'type'  => 'hidden',
                            'readonly'  => '1',
                        ),
                    array(
                            'id'    => 'lkIdPeg',
                            'name'  => 'ID',
                            'type'  => 'hidden',
                            'readonly'  => '1',
                        ),
                    array(
                            'id'    => 'lkTglAwal',
                            'name'  => 'TANGGAL AWAL',
                            'type'  => 'date',
                            'readonly'  => '0',
                        ),
                       array(
                            'id'    => 'lkTglAkhir',
                            'name'  => 'TANGGAL AKHIR',
                            'type'  => 'date',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'lkSkpTahun',
                            'name'  => 'SKP TAHUNAN',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'lkAtasan',
                            'name'  => 'NAMA ATASAN',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'lkIdPeg',
                            'name'  => 'PEGAWAI',
                            'type'  => 'autocomplete',
                            'comboapi'  => 'backend/public/api/admin/master/pegawai2forcombo',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'lkKegiatan',
                            'name'  => 'JENIS KEGIATAN',
                            'type'  => 'autocomplete',
                            'comboapi'  => 'backend/public/api/admin/master/angkakreditforcombo',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'lkAngkaKredit',
                            'name'  => 'ANGKA KREDIT',
                            'type'  => 'text',
                            'readonly'  => '1',
                        ),
                    array(
                            'id'    => 'lkTargetWaktu',
                            'name'  => 'TARGET WAKTU',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'lkBiaya',
                            'name'  => 'BIAYA',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'lkKeterangan',
                            'name'  => 'KETERANGAN',
                            'type'  => 'textarea',
                            'readonly'  => '0',
                        ),

                   

                )
);
