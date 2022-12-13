<?php
/*
 * Langguage mapping for Education
 */

return array(
    'title' => 'Master Pendidikan',
    'column' => array(
        array(
            'id'    => 'meduId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'meduDesc',
            'name'  => 'Education',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '100',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'IdDesc',
            'name'  => 'Pendidikan',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '100',
            'mandatory'=> '1'
        ),
        array(
            "id"=>"meduNonActiveDescription",
            "name"=>"Status",
            "show"=>1,
            "type"=>"varchar",
            "width"=>100,
        )
    )
);
