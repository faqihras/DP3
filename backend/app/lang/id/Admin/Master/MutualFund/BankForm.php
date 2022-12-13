<?php
/*
 * Langguage mapping for Bank Form
 */

return array(
    'title' => 'Master Mutual Fund Bank',
    'column' => array(
        array(
            'id'    => 'mmfbId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '10'
        ),
        array(
            'id'    => 'mmfbMmfuId',
            'name'  => 'Reksadana',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '60',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '60',
            'mandatory'=> '1'

        ),
        array(
            'id'    => 'mmfbMbnkId',
            'name'  => 'Bank',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '60',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '60',
            'mandatory'=> '1'
        ),
         array(
            'id'    => 'mmfbAccName',
            'name'  => 'Nama Rekening',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '60',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '60',
            'mandatory'=> '1'
        ),
         array(
            'id'    => 'mmfbAccNo',
            'name'  => 'No rekening',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '60',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '60',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'mmfbStatus',
            'name'  => 'Aktif',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '60'
        )
    )
);