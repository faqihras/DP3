<?php
/*
 * Langguage mapping for company
 */

return array(
    'title' => 'Master Company',
    'column' => array(
        array(
            'id'    => 'compId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'compNick',
            'name'  => 'Nick',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '150',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '10',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'compName',
            'name'  => 'Name',
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
            'id'    => 'compEmail',
            'name'  => 'Email',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '400',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '50',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'compNonActiveFlag',
            'name'  => 'Active',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        )        
    )
);
