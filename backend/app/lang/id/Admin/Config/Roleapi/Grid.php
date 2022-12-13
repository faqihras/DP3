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
            'width' => '250'
        ),  
        array(
            'id'    => 'roleNonActiveDescription',
            'name'  => 'Non Active',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100'
        )

    )
);
