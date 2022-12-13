<?php
/*
 * Langguage mapping for History
 */

return array(
    'title' => 'Master History',
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
            'width' => '150'
        ),
        array(
            'id'    => 'mmfuDesc',
            'name'  => 'Sejarah',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250'
        ),
		array(
            'id'    => 'type',
            'name'  => 'Jenis',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        ),
        array(
            'id'    => 'currency',
            'name'  => 'Mata Uang',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        ),
        array(
            'id'    => 'mmfuFufhIdProductSummaryDescription',
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