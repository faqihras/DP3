<?php
/*
 * Langguage mapping for Role
 */

return array(
    'title' => 'Master Admin',
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
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '50',
            'mandatory'=> '1'
        ),  
        array(
            'id'    => 'ausrPassword',
            'name'  => 'Password',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100'
        ),  
        array(
            'id'    => 'ausrActive',
            'name'  => 'Active',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100'
        ), 
        array(
            'id'    => 'ausrLastLogin',
            'name'  => 'Last Login',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100'
        ), 
        array(
            'id'    => 'ausrCreated',
            'name'  => 'Created',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100',
            'readonly'=> '1',
        ),
        array(
            'id'    => 'ausrRolhId',
            'name'  => 'Role',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250'
        ), 
    )
);
