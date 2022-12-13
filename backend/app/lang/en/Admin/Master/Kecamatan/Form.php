<?php
/*
 * Langguage mapping for Role
 */

return array( 
       "form"=>array(
                    array(
                            'id'    => 'kecId',
                            'name'  => 'ID',
                            'type'  => 'hidden',
                            'readonly'  => '1',
                        ),
                    array(
                            'id'    => 'kecKab',
                            'name'  => 'KABUPATEN/KOTA',
                            'type'  => 'autocomplete',
                            'comboapi'  => 'backend/public/api/admin/master/kabupatenforcombo',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'kecNama',
                            'name'  => 'NAMA',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                )
);
