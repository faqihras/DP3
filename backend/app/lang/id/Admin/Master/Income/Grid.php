<?php
/*
 * Langguage mapping for Income
 */

return array(
    'title' => 'Master Penghasilan',
    'column' => array(
        array(
            'id'    => 'myeiId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'myeiDesc',
            'name'  => 'Penghasilan',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '100',
            'mandatory'=> '1'
        )
    )
);
