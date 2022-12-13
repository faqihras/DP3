<?php
/*
 * Langguage mapping for Role
 */

return array( 
       "form"=>array(
                    array(
                            'id'    => 'kelId',
                            'name'  => 'ID',
                            'type'  => 'hidden',
                            'readonly'  => '1',
                        ),
                    array(
                            'id'    => 'kelKec',
                            'name'  => 'KECAMATAN',
                            'type'  => 'autocomplete',
                            'comboapi'  => 'backend/public/api/admin/master/kecamatanforcombo',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'kelNama',
                            'name'  => 'DESA / KELURAHAN',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                )
);
