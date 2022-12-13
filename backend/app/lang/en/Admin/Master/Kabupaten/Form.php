<?php
/*
 * Langguage mapping for Role
 */

return array( 
       "form"=>array(
                    array(
                            'id'    => 'kabId',
                            'name'  => 'ID',
                            'type'  => 'hidden',
                            'readonly'  => '1',
                        ),
                    array(
                            'id'    => 'kabProv',
                            'name'  => 'PROVINSI',
                            'type'  => 'combo',
                            'comboapi'  => 'backend/public/api/admin/master/provinsiforcombo',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'kabNama',
                            'name'  => 'NAMA',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                )
);
