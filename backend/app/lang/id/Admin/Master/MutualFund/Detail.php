<?php
/*
 * Langguage mapping for Mutual Fund
 */

return array(
    'title' => 'Master Mutual Fund',
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
            'name'  => 'Description',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250'
        ),
        array(
            'id'    => 'mmfuFufhIdProspectusDescription',
            'name'  => 'Prospectus',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        ),
        array(
            'id'    => 'mmfuFufhIdFactsheetDescription',
            'name'  => 'Facts Sheet',
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
            'type'  => 'integer',
            'width' => '100'
        ),
        array(
            'id'    => 'mmfuNonActiveDescription',
            'name'  => 'Non Active',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        )
    )
);