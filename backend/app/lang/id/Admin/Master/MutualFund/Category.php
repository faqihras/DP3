<?php
/*
 * Langguage mapping for Category
 */

return array(
    'title' => 'Master Category',
    'column' => array(
        array(
            'id'    => 'mmftId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'mmftNick',
            'name'  => 'Nick',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '4',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'mmftDesc',
            'name'  => 'History',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '50',
            'mandatory'=> '1'
        ),
	    array(
            'id'    => 'mmftNonActiveDescription',
            'name'  => 'Non Active',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        )
    )
);