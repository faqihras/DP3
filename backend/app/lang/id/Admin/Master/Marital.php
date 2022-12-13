<?php
/*
 * Langguage mapping for Marital
 */

return array(
    'title' => 'Master Marital',
    'column' => array(
        array(
            'id'    => 'mmarId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'mmarCode',
            'name'  => 'Code',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '130'
        ),
        array(
            'id'    => 'mmarDesc',
            'name'  => 'Description',
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
            'id'    => 'mmarFlagCoupleDescription',
            'name'  => 'Flag Couple',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100'
        )
    )
);
