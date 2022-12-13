<?php
/*
 * Langguage mapping for Fund Source
 */

return array(
    'title' => 'Master Sumber Dana',
    'column' => array(
        array(
            'id'    => 'mifsId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'mifsDesc',
            'name'  => 'Sumber Dana',
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