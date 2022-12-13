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
            'width' => '150',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '10',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'mmfuDesc',
            'name'  => 'Description',
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
            'id'    => 'mmfuFufhIdProspectus',
            'name'  => 'File Upload History ID (Prospectus)',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        ),
        array(
            'id'    => 'mmfuFufhIdFactsheet',
            'name'  => 'File Upload History ID (Facts Sheet)',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        ),
        array(
            'id'    => 'mmfuMcurId',
            'name'  => 'Currency',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        ),
        array(
            'id'    => 'mmfuFufhIdProductSummary',
            'name'  => 'Product Summery',
            'show'  => '1',
            'type'  => 'integer',
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