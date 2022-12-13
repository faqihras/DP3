<?php
/*
 * Langguage mapping for Legal Domicile
 */

return array(
    'title' => 'Master Legal Domisili',
    'column' => array(
        array(
            'id'    => 'mildId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'mildDesc',
            'name'  => 'Legal Domisili',
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
