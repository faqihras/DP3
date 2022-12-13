<?php
/*
 * Langguage mapping for sell unit
 */

return array(
    'title' => 'Master Unit Dijual',
    'column' => array(
        array(
            'id'    => 'rdhdId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'rdhdCustodyId',
            'name'  => 'Id Pelanggan',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '10',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'rdhdTradeConfirmation',
            'name'  => 'konfirmasi',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '50',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'rdhdDate',
            'name'  => 'Tanggal',
            'show'  => '1',
            'type'  => 'date',
            'width' => '200'
        ),
        array(
            'id'    => 'rdhdSellFee',
            'name'  => 'Biaya Penjualan',
            'show'  => '1',
            'type'  => 'amount',
            'width' => '100',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '8',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'rdhdRemarks',
            'name'  => 'Penanda',
            'show'  => '1',
            'type'  => 'text',
            'width' => '150'
        ),
        array(
            'id'    => 'rdhdStatus',
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
            'maxLength'=> '3',
            'mandatory'=> '1'
        )
    )
);

       