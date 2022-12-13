<?php
/*
 * Langguage mapping for Bank Form
 */

return array(
    'title' => 'Master Sectoral',
    'column' => array(
        array(
            'id'    => 'msecId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '10'
        ),
        array(
            'id'    => 'msecDescription',
            'name'  => 'Sectoral',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '60',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '60',
            'mandatory'=> '1'

        ),
        array(
            "id"=>"msecNonactiveFlag",
            "name"=>"Active",
            "show"=>1,
            "type"=>"varchar",
            "width"=>100,
        )
    )
);