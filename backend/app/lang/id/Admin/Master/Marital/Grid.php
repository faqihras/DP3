<?php
/*
 * Langguage mapping for Marital
 */

return array(
    'title' => 'Master Perkawinan',
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
            'name'  => 'Kode',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '130'
        ),
        array(
            'id'    => 'mmarDesc',
            'name'  => 'Deskripsi',
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
            'name'  => 'Flag Perkawinan',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100'
        )
    )
);
