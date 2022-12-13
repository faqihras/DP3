<?php
/*
 * Langguage mapping for Bank Form
 */

return array(
    'title' => 'Master Bank',
    'column' => array(
        array(
            'id'    => 'mbnkId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '10'
        ),
        array(
            'id'    => 'mbnkDesc',
            'name'  => 'Bank',
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
            "id"=>"mbnkNonActive",
            "name"=>"Aktif",
            "show"=>1,
            "type"=>"varchar",
            "width"=>100,
        )
    )
);