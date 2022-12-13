<?php
/*
 * Langguage mapping for Role
 */

return array( 
       "form"=>array(
                    array(
                            'id'    => 'gajiId',
                            'name'  => 'ID',
                            'type'  => 'hidden',
                            'readonly'  => '1',
                        ),
                    array(
                            'id'    => 'gajiGol',
                            'name'  => 'PANGKAT',
                            'type'  => 'autocomplete',
                            'comboapi'  => 'backend/public/api/admin/master/pangkatforcombo',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'gajiMsKerja',
                            'name'  => 'MASA KERJA',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'gajiRupiah',
                            'name'  => 'GAJI',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                )
);
