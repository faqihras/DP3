<?php
/*
 * Langguage mapping for Category
 */

return array(
    'title' => 'Master Kategori',
    'column' => array(
        array(
            'id'    => 'mmftId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'mmftNick',
            'name'  => 'Nick',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '2',
            'maxLength'=> '4',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'mmftDesc',
            'name'  => 'Sejarah',
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
            'id'    => 'mmftNonActive',
            'name'  => 'Tidak Aktif',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        )
    )
);