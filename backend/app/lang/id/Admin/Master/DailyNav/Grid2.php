<?php
/*
 * Langguage mapping for Education
 */

return array(
    'title' => 'Daily Nav',
    'column' => array(
        array(
            'id'    => 'navMrdnId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'navReksadanaNick',
            'name'  => 'Date',
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
            'id'    => 'navLatestNAV',
            'name'  => 'Latest Sync',
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
            'id'    => 'navDate',
            'name'  => 'Date',
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
