<?php
/*
 * Langguage mapping for Characteristic
 */

return array(
    'title' => 'Master Karakteristik',
    'column' => array(
        array(
            'id'    => 'mincId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'mincDesc',
            'name'  => 'Karakteristik',
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