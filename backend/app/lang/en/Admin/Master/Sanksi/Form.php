<?php
/*
 * Langguage mapping for Role
 */

return array( 
       "form"=>array(
                    array(
                            'id'    => 'sankId',
                            'name'  => 'ID',
                            'type'  => 'hidden',
                            'readonly'  => '1',
                        ),
                    array(
                            'id'    => 'sankNama',
                            'name'  => 'NAMA SANKSI',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'sankPersen',
                            'name'  => 'PERSEN (%)',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'sankJenis',
                            'name'  => 'JENIS SANKSI',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                )
);
