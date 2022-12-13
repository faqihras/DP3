<?php
/*
 * Langguage mapping for Role
 */

return array(
    'title' => 'Master User Customer',
    'column' => array(
        array(
            'id'    => 'userId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'userName',
            'name'  => 'Username',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250'
        ),
        array(
            'id'    => 'preview',
            'name'  => 'Preview',
            'show'  => '1',
            'type'  => 'preview',
            'width' => '100'
        ),
        array(
            'id'    => 'userNonActiveDescription',
            'name'  => 'Non Active',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100'
        ), 
        array(
            'id'    => 'urlPreview',
            'name'  => 'urlPreview',
            'show'  => '0',
            'type'  => 'varchar',
            'width' => '100'
        )
    )
);
