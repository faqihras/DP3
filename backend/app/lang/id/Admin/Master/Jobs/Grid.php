<?php
/*
 * Langguage mapping for Jobs
 */

return array(
    'title' => 'Master Pekerjaan',
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
            'name'  => 'Pekerjaan',
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
