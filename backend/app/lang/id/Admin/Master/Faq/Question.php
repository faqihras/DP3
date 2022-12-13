<?php
/*
 * Langguage mapping for Question
 */

return array(
    'title' => 'Master FAQ Question',
    'column' => array(
        array(
            'id'    => 'faqhId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'mfqcDesc',
            'name'  => 'FAQ Category',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '25',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'faqhDesc',
            'name'  => 'FAQ Question',
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