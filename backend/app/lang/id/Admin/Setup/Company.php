<?php
/*
 * Langguage mapping for company
 */

return array(
    'title' => 'Master Company',
    'column' => array(
        array(
            'id'    => 'compId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'compNick',
            'name'  => 'Nick',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '150',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '10',
            'mandatory'=> '1'
        ),
        array(
            'id'    => 'compName',
            'name'  => 'Name',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '50',
            'mandatory'=> '1'
        ),        
        array(
            'id'    => 'compAddress',
            'name'  => 'Address',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '300',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '100'
        ),
        array(
            'id'    => 'compPostCode',
            'name'  => 'Post Code',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '50',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '5'
        ),
        array(
            'id'    => 'compCity',
            'name'  => 'City',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '50'
        ),
        
        array(
            'id'    => 'compTelp',
            'name'  => 'Phone 1',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '150',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '20'
        ),
        array(
            'id'    => 'compTelp2',
            'name'  => 'Phone 2',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '150',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '20'
        ),
        array(
            'id'    => 'compFax',
            'name'  => 'Fax 1',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '150',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '20'
        ),
        array(
            'id'    => 'compFax2',
            'name'  => 'Fax 2',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '150',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '20'
        ),
        array(
            'id'    => 'compEmail',
            'name'  => 'Email',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '400',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '50'
        ),
        /*array(
            'id'    => 'compNonActiveFlag',
            'name'  => 'Non Active',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100'
        )*/
        array(
            'id'    => 'compCreatedTime',
            'name'  => 'Create Time',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '400',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '50'
        ),
        array(
            'id'    => 'compUpdatedTime',
            'name'  => 'Update Time',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '400',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '50'
        ),
    )
);
