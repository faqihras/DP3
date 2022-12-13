<?php
/*
 * Langguage mapping for Role
 */

return array( 
       "form"=>array(
                    array(
                            'id'    => 'menuId',
                            'name'  => 'ID',
                            'type'  => 'hidden',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'menuName',
                            'name'  => 'Menu',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),

                    array(
                            'id'    => 'menuLink',
                            'name'  => 'Menu Link',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),

                    array(
                            'id'    => 'menuOrder',
                            'name'  => 'Menu Order',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),

                    array(
                            'id'    => 'menuParentId',
                            'name'  => 'Parent',
                            'type'  => 'combo',
                            'comboapi'  => 'backend/public/api/admin/config/menuadminforcombo',
                            'readonly'  => '0',
                        ),

                    array(
                            'id'    => 'htmlLink',
                            'name'  => 'HTML Link',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),

                    array(
                            'id'    => 'apiData',
                            'name'  => 'API Data',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),

                    array(
                            'id'    => 'apiLangGrid',
                            'name'  => 'API Grid',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),

                    array(
                            'id'    => 'apiLangForm',
                            'name'  => 'API Form',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),
                    array(
                            'id'    => 'menuIcon',
                            'name'  => 'Menu Icon',
                            'type'  => 'text',
                            'readonly'  => '0',
                        ),

                )
);
