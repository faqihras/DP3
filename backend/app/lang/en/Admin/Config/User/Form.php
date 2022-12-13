<?php
/*
 * Langguage mapping for Role
 */

return array(
    'title' => 'Master User',
    'column' => array(
        array(
            'id'    => 'userId',
            'name'  => 'ID',
            'show'  => '0',
            'type'  => 'integer',
            'width' => '50'
        ),
        array(
            'id'    => 'userName',
            'name'  => 'Username',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '250',
            'minVal'=> '',
            'maxVal'=> '',
            'minLength'=> '1',
            'maxLength'=> '30',
            'mandatory'=> '1'
        ),  
        array(
            'id'    => 'userFullName',
            'name'  => 'Full Name',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100'
        ),  
        array(
            'id'    => 'userPassword',
            'name'  => 'Password',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100'
        ),  
        array(
            'id'    => 'userFirstLogin',
            'name'  => 'First Login',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        ),
        array(
            'id'    => 'userValidityStart',
            'name'  => 'Validity Start',
            'show'  => '1',
            'type'  => 'date',
            'width' => '100'
        ),  
        array(
            'id'    => 'userValidityEnd',
            'name'  => 'Validity End',
            'show'  => '1',
            'type'  => 'date',
            'width' => '100'
        ),  
        array(
            'id'    => 'userLanguage',
            'name'  => 'Language',
            'show'  => '1',
            'type'  => 'integer',
            'selector' => array( 
                '1' => 'English',
                '2' => 'Indonesia',
                '3' => 'Other'),
            'width' => '100'
        ),
        array(
            'id'    => 'userFingerPrintId',
            'name'  => 'Finger Print Id',
            'show'  => '1',
            'type'  => 'varchar',
            'width' => '100'
        ),  
        array(
            'id'    => 'userLastLogin',
            'name'  => 'Last Login',
            'show'  => '1',
            'type'  => 'date',
            'width' => '100'
        ),  
        array(
            'id'    => 'userLastPasswordChange',
            'name'  => 'Last Password Change',
            'show'  => '1',
            'type'  => 'date',
            'width' => '100'
        ),
        array(
            'id'    => 'userNonActive',
            'name'  => 'Active',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        ),
        array(
            'id'    => 'userRolhId',
            'name'  => 'Role',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'
        ),
        array(
            'id'    => 'uscoCompId',
            'name'  => 'Company',
            'show'  => '1',
            'type'  => 'integer',
            'width' => '100'  
        )
    )
);
