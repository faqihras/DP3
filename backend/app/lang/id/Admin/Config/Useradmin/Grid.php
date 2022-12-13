<?php
/*
 * Langguage mapping for Role
 */

return array(
    'title' => 'Master User Admin',
    'column' => array(
        array(
            'id'    => 'ausrId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'ausrUsername',
            'name'  => 'Username',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250'
        ), 
        array(
            'id'    => 'roleName',
            'name'  => 'Role',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250'
        ), 
        array(
            'id'    => 'userNonActiveDescription',
            'name'  => 'Non Active',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100'
        )

    )
);
