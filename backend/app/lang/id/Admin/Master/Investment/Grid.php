<?php
/*
 * Langguage mapping for Investment
 */

return array(
    'title' => 'Master Investasi',
    'column' => array(
        array(
            'id'    => 'minoId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'minoDesc',
            'name'  => 'Investasi',
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
            'id'    => 'minoFlagOtherDescription',
            'name'  => 'Flag Lainnya',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100'
        )
    )
);
