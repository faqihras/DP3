<?php
/*
 * Langguage mapping for Role
 */

return array( 
       "form"=>array(
                    array(
                            'id'    => 'ausrId',
                            'name'  => 'ID',
                            'type'  => 'hidden',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'ausrUsername',
                            'name'  => 'USER LOGIN',
                            'type'  => 'text',
                            'readonly'  => '1',
                        ),
                    array(
                            'id'    => 'ausrName',
                            'name'  => 'NAMA LENGKAP',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'ausrPassword',
                            'name'  => 'PASSWORD',
                            'type'  => 'password',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'ausrPassword2',
                            'name'  => 'ULANGI PASSWORD',
                            'type'  => 'password',
                            'readonly'  => '0',
                        ),
                )
);
