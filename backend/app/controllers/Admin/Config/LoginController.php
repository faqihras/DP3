<?php
namespace Admin\Config;

use Response;
use Validator;
use Input;
use Controller;
use Session;
use DB;
use DateTime;
use Hash;

class LoginController extends Controller {
    
    /**
     * Authenticate user login
     * 
     * @return json
     */
    public function store()
    {

        $data=Input::all();

        $data['username']=!empty($data['username']) ? $data['username']:'x';
        $data['password']=!empty($data['password']) ? $data['password']:'x';
        $data['modul']=!empty($data['modul']) ? $data['modul']:1;
        $data['thnang']=!empty($data['thnang']) ? $data['thnang']:date("Y");


        if(!empty($data['newpassword'])){
            $newpass=$data['newpassword'];
            DB::update('update admin_users set ausrFirstLogin = 0,ausrPassword="'.Hash::make($data['newpassword']).'" where ausrUsername ="'.$data['username'].'" ');                                
            $data['password']=$newpass;
        }



        $valcapt = FALSE;
        if(!empty($data['captcha'])){
            $rules =  array('captcha' => array('required', 'captcha'));
            $validator = Validator::make($data, $rules);
            $valcapt = $validator->fails();
//            if ($validator->fails())
            if ($valcapt)
            {
                $now=Session::get('userWrongInput');
                $now=$now+1;
                if($now==6){
                    DB::update('update admin_users set ausrBannedTime = "'.date('Y-m-d h:i:s').'" where ausrUsername ="'.$data['username'].'" ');
                }
                Session::put('userWrongInput',$now);
                $json['status']['error']=1;
                $json['status']['errorCode']=401;
                $json['status']['message']='wrong captcha';
                return $json;
            }
        }


        // validate the info, create rules for the inputs
        $rules = array(
            'username'    => 'required', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make($data, $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails() or $valcapt) {
            $now=Session::get('userWrongInput');
            $now=!empty($now) ? $now:0;
            $now=$now+1;
            Session::put('userWrongInput',$now);

            if(Session::has('userWrongInput')){
                if(Session::get('userWrongInput')<=2){
                    Session::put('chaptSession',0);
                    //return 119; //wrong id or password
                    $json['status']['error']=1;
                    $json['status']['errorCode']=119;
                    $json['status']['message']='wrong id or password';
                    return $json;

                }elseif(Session::get('userWrongInput')==6){
                    //$tanggal=date('Y-m-d h:i:s');
                    Session::put('userWrongInput',0);
                    DB::update('update admin_users set ausrBannedTime = "'.date('Y-m-d h:i:s').'" where ausrUsername ="'.$data['username'].'" ');
                    return 9999;

                }

                if(Session::get('userWrongInput')>2){
                    Session::put('chaptSession',1);
                    $json['status']['error']=1;
                    $json['status']['errorCode']=400;
                    $json['status']['message']='show captcha';
                    return $json;
                }

                $result = DB::select('select ausrBannedTime,ausrFirstLogin from admin_users where ausrUsername = "'.$data['username'].'" ');
                $lastWrongTime='0000-00-00 00:00:00';
                if(count($result)>0){
                    $lastWrongTime=$result[0]->ausrBannedTime;                            
                }

                $datetime1 = new DateTime();
                $datetime2 = new DateTime($lastWrongTime);
                $interval = $datetime1->diff($datetime2);
                $selisih = $interval->format('%i');

                if($lastWrongTime=='0000-00-00 00:00:00'){
                    $selisih=11;    
                }else{
                    $selisih=1;                    
                }

                if($selisih<=10){                
                    $result = Response::message(9999);
                    return $result;                                
                }                


                return $json;
            }
            //return Response::message(119);
        } else {

            // create our user data for the authentication
            $userdata = array(
                'username' 	=> $data['username'],
                'password' 	=> $data['password'],
                'modul'  => $data['modul'],
                'thnang'  => $data['thnang']
            );

            $paramSession=array(
                'modul'  => $data['modul'],
                'thnang'  => $data['thnang']
                );

            
            $result = DB::select('select ausrBannedTime,ausrFirstLogin from admin_users where ausrUsername = "'.$data['username'].'" ');
            $lastWrongTime='0000-00-00 00:00:00';
            if(count($result)>0){
                $lastWrongTime=$result[0]->ausrBannedTime;                            
            }

            $datetime1 = new DateTime();
            $datetime2 = new DateTime($lastWrongTime);
            $interval = $datetime1->diff($datetime2);
            $selisih = $interval->format('%i');

            if($lastWrongTime=='0000-00-00 00:00:00'){
                $selisih=11;    
            }
            

            if($selisih>10){                
                $login = new \Agape\Auth\Loginadmin();
                $data = $login->authentication($userdata);
                
                if(is_array($data)){
                    $result = Response::json($data);
                } else {
                    $result = Response::message($data);
                }
                
                //return Session::all();
                return $result;
            }else{
                $result = Response::message(9999);
                return $result;                
            }
        }
    }
}