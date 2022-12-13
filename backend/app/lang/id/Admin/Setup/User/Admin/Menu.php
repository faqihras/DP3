<?php


return array(
    'title' => 'Master Menu',
    'column' => array(
        array(
            "id"=>"menuId",
            "name"=>"ID",
            "show"=>"0",
            "type"=>"integer",
            "width"=>"50"
        ),
        array(
            "id"=>"menuName",
            'name'  => 'Menu Name',
            "show"=>1,
            "type"=>"varchar",
            "width"=>150,
            "minVal"=>"",
            "maxVal"=>"",
            "minLength"=>"2",
            "maxLength"=>"10",
            "mandatory"=>"1"
        ),
        array(
            "id"=>"menuNonActive",
            'name'  => 'Non Active',
            "show"=>1,
            "type"=>"varchar",
            "width"=>150,
            "minVal"=>"",
            "maxVal"=>"",
            "minLength"=>"2",
            "maxLength"=>"10",
            "mandatory"=>"1"
        )
    ),
    "status"=>array(
        "error"=>0,
        "errorCode"=>0,
        "message"=>""
    )
);


