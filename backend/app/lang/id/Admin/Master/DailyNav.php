<?php 
	return array(
		"title" => "Daily NAV",
		'column' => array(
			array(
				'id'    => 'navReksadanaNick',
            	'name'  => 'Reksadana Nick',
            	'show'  => '1',
            	'type'  => 'varchar',
	            'width' => '100',
	            'minVal'=> '',
	            'maxVal'=> '',
	            'minLength'=> '2',
	            'maxLength'=> '50',
	            'mandatory'=> '1'
			),
			array(
				'id'    => 'navLatestNAV',
            	'name'  => 'Latest NAV',
            	'show'  => '1',
            	'type'  => 'amount',
            	'width' => '100',
            	'minVal'=> '',
            	'maxVal'=> '',
            	'minLength'=> '2',
            	'maxLength'=> '20',
            	'mandatory'=> '1'
			),
			array(
				'id'    => 'navDate',
            	'name'  => 'Date',
            	'show'  => '1',
            	'type'  => 'date',
            	'width' => '100',
            	'minVal'=> '',
            	'maxVal'=> '',
            	'minLength'=> '2',
            	'maxLength'=> '20',
            	'mandatory'=> '1'
			)
		)
	);


?>