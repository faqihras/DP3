<?php
/*
 * Langguage mapping for Bank
 */

return array(
    'title' => 'Master Bank Reksadana',
    'column' => array(
        array(
            'id'    => 'mmfbId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '10'
        ),
        array(
            'id'    => 'reksadana',
            'name'  => 'Produk Reksadana',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250'
        ),
        array(
            'id'    => 'mbnkDesc',
            'name'  => 'Bank',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '200'
        ),
        array(
            'id'    => 'Status',
            'name'  => 'Aktif',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '60'
        )
    )
);