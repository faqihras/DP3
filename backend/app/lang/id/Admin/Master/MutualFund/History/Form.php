<?php
/*
 * Langguage mapping for History
 */

return array(
    'title' => 'Master Sejarah',
    'column' => array(
        array(
            'id'    => 'mmfuId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'mmfuNick',
            'name'  => 'Nick',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '150',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '10',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'mmfuDesc',
            'name'  => 'Sejarah',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '60',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'mmfuMmftId',
            'name'  => 'Jenis',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        ),	
        array(
            'id'    => 'mmfuMcurId',
            'name'  => 'Mata Uang',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        ),
        array(
            'id'    => 'mmfuFufhIdProductSummary',
            'name'  => 'Ringkasan Produk',
            'show'  => '1',
            'type'  => 'file',
            'width' => '100'
        ),
        array(
            'id'    => 'mmfuNonActive',
            'name'  => 'Tidak Aktif',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        )
    )
);