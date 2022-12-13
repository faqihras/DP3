<?php
/*
 * Langguage mapping for fundSource
 */

return array(
    'title' => 'Master Fund Source',
    'column' => array(
        array(
            'id'    => 'mfusId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'mfusDesc',
            'name'  => 'Fund Source',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '200',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '100',
            'mandatory'=> '1'
        ),
        array(
            "id"=>"mfusNonActiveDescription",
            "name"=>"Actif",
            "show"=>1,
            "type"=>"varchar",
            "width"=>100,
        )
    )
);