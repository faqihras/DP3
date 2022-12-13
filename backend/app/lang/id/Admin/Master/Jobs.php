<?php
/*
 * Langguage mapping for Jobs
 */

return array(
    'title' => 'Master Jobs',
    'column' => array(
        array(
            'id'    => 'mjobId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'mjobDesc',
            'name'  => 'Job Description',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '100',
            'mandatory'=> '1'
        )
    )
);
