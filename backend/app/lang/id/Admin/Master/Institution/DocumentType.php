<?php
/*
 * Langguage mapping for DocumentType
 */

return array(
    'title' => 'Master Document Type',
    'column' => array(
        array(
            'id'    => 'midtId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'midtDesc',
            'name'  => 'Document Type',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '250',
            'mandatory'=> '1'
        )
    )
);