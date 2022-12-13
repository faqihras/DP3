<?php 
	return array(
		'title' => 'Register User Online',
		'column' => array(
			array(
	            "id"=>"userId",
	            "name"=>"ID",
	            "show"=>"0",
	            "type"=>"integer",
	            "width"=>"50"
       		 ),
			 array(
	            "id"=>"userName",
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
	            "id"=>"userNonActive",
	            "name"=>"Aktif",
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
	            "id"=>"userType",
	            "name"=>"Type",
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
	            "id"=>"userEmail",
	            "name"=>"Email",
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
	            "id"=>"userFirstName",
	            "name"=>"First Name",
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
	            "id"=>"userMiddleName",
	            "name"=>"Middle Name",
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
	            "id"=>"userLastName",
	            "name"=>"Last Name",
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
		'status' => array(
			"error" => 0,
			"errorCode" => 0,
			"message" => ""
		)

	);

?>