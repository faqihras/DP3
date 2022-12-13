<?php
/*
 * Langguage mapping for Role
 */

return array( 
       "form"=>array(
                    array(
                            'id'    => 'satkerId',
                            'name'  => 'ID',
                            'type'  => 'hidden',
                            'readonly'  => '1',
                        ),
                    array(
                            'id'    => 'satkerSkpd',
                            'name'  => 'NAMA SKPD',
                            'type'  => 'autocomplete',
                            'comboapi'  => 'backend/public/api/admin/master/skpdforcombo',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'satkerNama',
                            'name'  => 'NAMA UNIT',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                )
);
