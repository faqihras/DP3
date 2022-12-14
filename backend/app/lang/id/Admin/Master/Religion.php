<?php
/*
 * Langguage mapping for Religion
 */

return array(
    'title' => 'Master Religion',
    'column' => array(
        array(
            'id'    => 'mrelId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'mrelCode',
            'name'  => 'Religion Code',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '150'
        ),
        array(
            'id'    => 'mrelDesc',
            'name'  => 'Religion',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minLength'=> '2',
            'maxLength'=> '100',
            'mandatory'=> '1'
        )
    )
);
