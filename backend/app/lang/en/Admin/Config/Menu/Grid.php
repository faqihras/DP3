<?php
/*
 * Langguage mapping for Menu
 */

return array(
    'title' => 'Master Menu Customer',
    'column' => array(
        array(
            'id'    => 'menuId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'menuName',
            'name'  => 'Menu',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '350'
        ),
        array(
            'id'    => 'menuOrder',
            'name'  => 'Order',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '350'
        ),
        array(
            'id'    => 'menuNonActiveDescription',
            'name'  => 'Active',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        )
    )
);
