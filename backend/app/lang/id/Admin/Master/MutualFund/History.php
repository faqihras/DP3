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
            'name'  => 'History',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250'
        ),
		array(
            'id'    => 'type',
            'name'  => 'Type',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        ),
        array(
            'id'    => 'currency',
            'name'  => 'Currency',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        ),
        array(
            'id'    => 'mmfuFufhIdProductSummaryDescription',
            'name'  => 'Product Summery',
            'show'  => '1',
            'type'  => 'file',
            'width' => '100'
        ),
        array(
            'id'    => 'mmfuNonActive',
            'name'  => 'Non Active',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        )
    )
);