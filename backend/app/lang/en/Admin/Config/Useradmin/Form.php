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
                            'name'  => 'USER',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'ausrName',
                            'name'  => 'NAMA',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'ausrPassword',
                            'name'  => 'SANDI',
                            'type'  => 'password',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'ausrRolhId',
                            'name'  => 'GRUP',
                            'type'  => 'combo',
                            'comboapi'  => 'backend/public/api/admin/config/roleforcombo',
                            'readonly'  => '0',
                        ),
                )
);
