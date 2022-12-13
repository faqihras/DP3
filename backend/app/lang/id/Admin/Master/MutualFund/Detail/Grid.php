<?php
/*
 * Langguage mapping for Mutual Fund
 */

return array(
    'title' => 'Master Reksadana',
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
            'name'  => 'Deskripsi',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250'
        ),
        array(
            'id'    => 'mmfuFufhIdProspectusDescription',
            'name'  => 'File Prospectus',
            'show'  => '1',
            'type'  => 'download',
            'width' => '200'
        ),
        array(
            'id'    => 'mmfuFufhIdFactsheetDescription',
            'name'  => 'File Facts Sheet',
            'show'  => '1',
            'type'  => 'download',
            'width' => '200'
        ),
        array(
            'id'    => 'currency',
            'name'  => 'Mata Uang',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '200'
        ),
        array(
            'id'    => 'mmfuFufhIdProductSummaryDescription',
            'name'  => 'Ringkasan Produk',
            'show'  => '1',
            'type'  => 'download',
            'width' => '200'
        ),
        array(
            'id'    => 'mmfuNonActiveDescription',
            'name'  => 'Tidak Aktif',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        )
    )
);