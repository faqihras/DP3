<?php 
	return array(
		'title' => 'Register User',
		'column' => array(
			array(
	            "id"=>"uid",
	            "name"=>"ID",
	            "show"=>"0",
	            "type"=>"integer",
	            "width"=>"50"
       		 ),
			 array(
	            "id"=>"ausrUsername",
	            "name"=>"Username",
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
	            "id"=>"ausrLastLogin",
	            "name"=>"Last Login",
	            "show"=>1,
	            "type"=>"date",
	            "width"=>150,
	            "minVal"=>"",
	            "maxVal"=>"",
	            "minLength"=>"2",
	            "maxLength"=>"10",
	            "mandatory"=>"1"
        	),
		),
		'status' => array(
			"error" => 0,
			"errorCode" => 0,
			"message" => ""
		)

	);

?>