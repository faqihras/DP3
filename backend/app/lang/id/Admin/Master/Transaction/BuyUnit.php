<?php
/*
 * Langguage mapping for buy unit
 */

return array(
    'title' => 'Master Unit Dibeli',
    'column' => array(
        array(
            'id'    => 'sbhdId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '10'
        ),
        array(
            'id'    => 'sbhdCustodyId',
            'name'  => 'Id Pelanggan',
            'show'  => '0',
            'type'  => 'varchar',
            'width' => '10',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '10',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'sbhdTradeConfirmation',
            'name'  => 'Konfirmasi',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '150',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '100',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'sbhdDate',
            'name'  => 'Tanggal',
            'show'  => '1',
            'type'  => 'date',
            'width' => '150'
        ),
        array(
            'id'    => 'sbhdBuyFee',
            'name'  => 'Biaya Pembelian',
            'show'  => '1',
            'type'  => 'amount',
            'width' => '100',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '20',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'sbhdRemarks',
            'name'  => 'Penanda',
            'show'  => '1',
            'type'  => 'text',
            'width' => '100',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '150',
            'mandatory'=> '1'      
       ),
        array(
            'id'    => 'sbhdStatus',
            'name'  => 'Status',
            'show'  => '1',
            'type'  => 'integer',
            'selector' => array( 
                '0' => 'New',
                '1' => 'Confirmed'),
            'width' => '100',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '150',
            'mandatory'=> '1'
        )
    )
);       