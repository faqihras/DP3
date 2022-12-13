<?php
/*
 * Langguage mapping for Menu
 */

return array(
    'title' => 'Master Menu',
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
            'width' => '50',
            'mandatory' => '1',
        ),
        array(
            'id'    => 'menuNameInd',
            'name'  => 'Menu Name Indonesia',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '50'
        ),
        array(
            'id'    => 'menuNameEng',
            'name'  => 'Menu Name English',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '50'
        ),
        array(
            'id'    => 'menuAPI',
            'name'  => 'API',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '255'
        ),
        array(
            'id'    => 'menuModal',
            'name'  => 'Modal',
            'selector' => 
                array(
                    '0',
                    '1',
                ),
            'show'  => '1',
            'type'  => 'tinyint',
            'width' => '4'
        ),
        array(
            'id'    => 'menuLink',
            'name'  => 'URL',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100'
        ),
        array(
            'id'    => 'menuParentId',
            'name'  => 'Parent',
            'show'  => '1',
            'type'  => 'int',
            'width' => '10'
        ), 
        array(
            'id'    => 'menuOrder',
            'name'  => 'Order',
            'show'  => '1',
            'type'  => 'tinyint',
            'width' => '4'
        ),  
        array(
            'id'    => 'menuNonActive',
            'name'  => 'Active',
            'selector' => 
                array(
                    '0',
                    '1',
                ),
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100'
        )

    )
);
