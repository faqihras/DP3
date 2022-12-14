<?php
/*
 * Langguage mapping for HeirRelationship
 */

return array(
    'title' => 'Master Heir Relationship',
    'column' => array(
        array(
            'id'    => 'mherId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'mherDesc',
            'name'  => 'Heir Relationship',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '100',
            'mandatory'=> '1'
        )
    )
);