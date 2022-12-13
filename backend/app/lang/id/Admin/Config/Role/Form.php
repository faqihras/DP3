<?php
/*
 * Langguage mapping for Role
 */

return array(
    'title' => 'Master Role',
    'column' => array(
        array(
            'id'    => 'roleId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'roleName',
            'name'  => 'Role',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '50'
        ),  
        array(
            'id'    => 'roleNonActive',
            'name'  => 'Non Active',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '60'
        ),        
        'detail' => array(
            array(
                'id'    => 'menuName',
                'name'  => 'Menu',
                'show'  => '1',
                'type'  => 'varchar',
                'width' => '350'
            ),
            array(
                'id'    => 'rolmMenuId',
                'name'  => 'ID',
                'show'  => '0',
                'type'  => 'integer',
                'width' => '50'
            ),
            array(
                'id'    => 'rolmView',
                'name'  => 'View',
                'show'  => '1',
                'type'  => 'integer',
                'width' => '50'
            ),
            array(
                'id'    => 'rolmNew',
                'name'  => 'New',
                'show'  => '1',
                'type'  => 'integer',
                'width' => '50'
            ),
            array(
                'id'    => 'rolmEdit',
                'name'  => 'Edit',
                'show'  => '1',
                'type'  => 'integer',
                'width' => '50'
            ),
            array(
                'id'    => 'rolmDelete',
                'name'  => 'Delete',
                'show'  => '1',
                'type'  => 'integer',
                'width' => '50'
            ),
            array(
                'id'    => 'rolmConfirm',
                'name'  => 'Confirm',
                'show'  => '1',
                'type'  => 'integer',
                'width' => '50'
            ),
            array(
                'id'    => 'rolmVoid',
                'name'  => 'Void',
                'show'  => '1',
                'type'  => 'integer',
                'width' => '50'
            ),
            array(
                'id'    => 'rolmApprove',
                'name'  => 'Approve',
                'show'  => '1',
                'type'  => 'integer',
                'width' => '50'
            )
        )
    )
);
