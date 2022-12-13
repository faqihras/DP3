<?php
/*
 * Langguage mapping for FAQ Category
 */

return array(
    'title' => 'Master FAQ Category',
    'column' => array(
        array(
            'id'    => 'mfqcId',
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
        )
    )
);