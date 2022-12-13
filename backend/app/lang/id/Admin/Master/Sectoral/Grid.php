<?php
/*
 * Langguage mapping for Bank
 */

return array(
    'title' => 'Master Sectoral',
    'column' => array(
        array(
            'id'    => 'msecId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'msecDescription',
            'name'  => 'Description',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '150',
            'mandatory'=> '1'
        ),
        array(
            "id"=>"msecNonactiveDescription",
            "name"=>"Status",
            "show"=>1,
            "type"=>"varchar",
            "width"=>100,
        )
    )
);