<?php
/*
 * Langguage mapping for DocumentType
 */

return array(
    'title' => 'Master Tipe Dokumen',
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
            'name'  => 'Tipe Dokumen',
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