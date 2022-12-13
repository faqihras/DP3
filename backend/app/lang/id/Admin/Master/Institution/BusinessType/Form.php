<?php
/*
 * Langguage mapping for BusinessType
 */

return array(
    'title' => 'Master Jenis Bisnis',
    'column' => array(
        array(
            'id'    => 'mbutId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'mbutDesc',
            'name'  => 'Jenis Bisnis',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '100',
            'mandatory'=> '1'
        )
    )
);