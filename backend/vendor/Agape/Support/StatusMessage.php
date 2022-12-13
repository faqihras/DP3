<?php
/**
 * StatusMessage is list of status response message.
 * This contains:
 * <100 : Process has been successed
 * >100 : Process was failed
 * Validation error 
 * DB Foreign key issue
 * 
 */

namespace Agape\Support;

class StatusMessage {
    private $status;
    
    public function __construct() {
        $this->status   = array(
            // 1-100 : Process has been successed
            1           => 'no error',
            2           => 'data has been deleted',
            3           => 'data has been updated',
            4           => 'data has been updated but no affected row',
            5           => 'data has been saved',
            6           => 'company saved to session',
          //  7           => 'registration was completed, please check email for activation',
            8           => 'activated user sussessfully',
            9           => 'login success',
            10          => 'logout success',
            11          => 'change password success',
            12          => 'menu parent was change',
            13          => 'email has been send',
            14          => 'data was confirmed',
            15          => 'Token has been sent to the email, please check your email',
            16          => 'Image was deleted',
            17          => 'Language has been saved',
            18          => 'Valid user',
            19          => 'no row affected',
            
            20          => 'valid role',
            
            // >100 : Process was failed
            118         => 'inactive user',
            121         => 'login out of allowed time',
            144         => 'you dont have permission to access this action',
            401         => 'inactive role',
            402         => 'role out of allowed time',
            
            101         => 'id not available in the database',
            102         => 'invalid query',
            103         => 'no data available',
            104         => 'page excedeed',
            105         => 'no label found',
            106         => 'error updating data',
            107         => 'save failed',
            108         => 'invalid input',
            109         => 'you must inset agent before',
            400         => 'you cannot access page, because you are not login',
            403         => 'you must set company before',            
            110         => 'upload configuration is not found',
            111         => 'you must select company before',
            112         => 'no company select',
            113         => 'invalid company',
            114         => 'username was used',
            115         => 'password and reset password are not the same',
            116         => 'email was used',
            117         => 'invalid activation',
            119         => 'Wrong Id or Password',
            120         => 'session expired',
            122         => 'login not administrator',
            123         => 'verification invalid',
            124         => 'user banned',
            125         => 'user is not allow to login',
            126         => 'user already login',
            127         => 'invalid property id',
            128         => 'invalid confirm password',
            129         => 'wrong password',
            130         => 'change password failed',
            131         => 'save form header failed',
            132         => 'invalid form code',
            133         => 'password is not change',
            134         => 'error saving data',
            135         => 'company has been set',
            136         => 'invalid admin id',
            137         => 'page exedeed',
            138         => 'cannot delete this data, because it was used in another place',
            139         => 'you cannot access this page',
            140         => 'wrong id or password',
            141         => 'invalid id parameter',
            142         => 'you must insert franchise listing before',
            143         => 'data already exist',
            
            145         => 'invalid menu parent',
            146         => 'menu parent cannot change',
            147         => 'cannot delete this menu, because this menu has child',
            148         => 'you cannot use this action',
            149         => 'this survey was closed',
            150         => 'cannot print this page because this page previously printed',
            151         => 'form not allowed form for public',
            152         => 'email cannot be sent',
            153         => 'invalid id agent',
            154         => 'login failed, invalid company',
            155         => 'company setting is disable for subdomain company',
            156         => 'post data to server error',
            157         => 'invalid link',
            158         => 'invalid approval',
            159         => 'cant modify data, because data was confirmed',
            160         => 'menu is empty',
            161         => 'invalid registration id',
            162         => 'no configuration email receiver, please contact web administrator',
            163         => 'failed to send email, please contact web administrator',
            164         => 'invalid token',
            
            // Validation error 
            165         => 'only number allowed',
            166         => 'only alphabet allowed',
            167         => 'only alphanumeric allowed',
            168         => 'only alphabet without space allowed',
            169         => 'only alphanumeric without space allowed',
            170         => 'file type not valid',
            171         => 'file to large, maximum file 2 MB',
            172         => 'file too large',
            173         => 'is already exist',
            174         => 'invalid email',
            175         => 'invalid date format (YYYY-MM-DD)',
            176         => 'invalid input',
            177         => 'this date was expired',
            178         => 'field must not be empty',

            179         => 'invalid membership id',
            180         => 'invalid header id',
            181         => 'Error deleting image',
            182         => 'Invalid language id',
            183         => 'Invalid Field',
            184         => 'This property was closed before',
            185         => 'No property selected',

            186         => 'invalid id contract item',
            187         => 'invalid id payment item',
            188         => 'invalid id royalty item',
            189         => 'just allow input < 100',

            190         => 'invalid post data',
            191         => 'invalid branch id',
            192         => 'invalid agent id',
            193         => 'percentage total must be 100%',
            194         => 'only can fill percentage or amount',
            195         => 'start date bigger than end date',
            196         => 'field must empty',
            197         => 'field must same as co-listing',
            198         => 'start date bigger than end date',
            199         => 'field must be empty',
            200         => 'solo selling',
            201         => 'co-broking not exists',
            202         => 'referral not exists',
            203         => 'you dont have id agent for login',
            204         => 'agent already have username',
            205         => 'data have been voided',
            206         => "can't void unvoidable data",
            207         => "model is not suitable to do confirm",
            208         => "model is not suitable to do void",  
            
            300         => "incorrect pin",  
            301         => "pin is not match",  
            400         => "show captcha",
            401         => "Wrong Captcha",
            // DB Foreign key issue
            1451        => 'cannot delete this data, because this data was used in another transaction',
            9999        => 'your account has been banned, wait 10 minutes',
        );
    }
    
    public function get($id){
        return isset($this->status[$id])? $this->status[$id] : null;
    }
}

