<?php
/*
 * Langguage mapping for Bank
 */

return array(
    'title' => 'Master Bank',
    'column' => array(
        array(
            'id'    => 'mbnkId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'mbnkDesc',
            'name'  => 'Bank',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '150',
            'mandatory'=> '1'
        )
    )
);