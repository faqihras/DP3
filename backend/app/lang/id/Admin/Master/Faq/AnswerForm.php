<?php
/*
 * Langguage mapping for Answer
 */

return array(
    'title' => 'Master FAQ Answer',
    'column' => array(
        array(
            'id'    => 'faqdId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'faqdFaqhId',
            'name'  => 'FAQ Question',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '350',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '150',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'faqdDesc',
            'name'  => 'FAQ Answer',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '350',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '150',
            'mandatory'=> '1'
        )
    )
);