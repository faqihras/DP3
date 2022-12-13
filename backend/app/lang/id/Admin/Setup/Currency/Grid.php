<?php


return array(
    'title' => 'Master Currency',
    'column' => array(
        array(
            "id"=>"mcurId",
            "name"=>"ID",
            "show"=>"0",
            "type"=>"integer",
            "width"=>"50"
        ),
        array(
            "id"=>"mcurNick",
            "name"=>"Nick Currency",
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
            "id"=>"mcurDesc",
            "name"=>"Currency",
            "show"=>1,
            "type"=>"varchar",
            "width"=>200,
            "minVal"=>"",
            "maxVal"=>"",
            "minLength"=>"2",
            "maxLength"=>"100",
            "mandatory"=>"1"
        ),
        array(
            "id"=>"mcurNonActiveDescription",
            "name"=>"Active",
            "show"=>1,
            "type"=>"varchar",
            "width"=>200,
        )
    ),
    "status"=>array(
        "error"=>0,
        "errorCode"=>0,
        "message"=>""
    )
);


