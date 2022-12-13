<?php
namespace Admin\Config;

use Auth;
use Response;
use Config;
use Redirect;
use Validator;
use Input;
use Session;

class AuthController extends \Controller {
    
    public function index() {
//        if (Auth::check())


        if((Session::get('userIdAdmin')!='') and (Session::has('userIdAdmin'))){

            $role = new \Agape\Auth\Role();
            $validRole = $role->authentication();
            if($validRole != 20){
                $response = Response::message($validRole);
            } else {
                $response = Response::message(18);
            }
            
            print_r($validRole);
            
            $response["session"] = array(
                "userName" => Session::get('userNameAdmin'),
                "timeout" => (Config::get('session.lifetime')) * 60000
            );
            $response["company"] = array(
                    "companyIdAdmin"     => Session::get('companyIdAdmin'),
                    "companyNameAdmin"   => Session::get('companyNameAdmin')
            );
            return Response::json($response);
        } else {
            if(Session::has('companyIdAdmin') && Session::has('tempUserIdAdmin')){
                $userObj = new \Agape\Auth\Loginadmin();
                $user = $userObj->getUser(Session::get('tempUserIdAdmin'));   
                $comp = $userObj->getCompany();
                $userdata = array(
                    'username' 	=> $user['userName'],
                    'password' 	=> Session::get('tempPwAdmin')
                );
                
                if(!(Auth::attemptAdmin($userdata))){
                    return Response::message(119);
                }
                
                $userObj->setSession($user, $comp);
                
                Session::forget('tempPwAdmin');
                Session::forget('userFirstLoginAdmin');
                Session::forget('companyListAdmin');
                
                return $this->index();
            } else if(Session::has('userFirstLoginAdmin') && Session::has('companyListAdmin')){
                $result = Response::message(119);
                $result['data'] = array(
                    'userFirstLogin' => Session::get('userFirstLoginAdmin'),
                    'companyList' => Session::get('companyListAdmin')
                );
                return $result;
            } else {
                return Response::message(119);
            }
        }
        
    }
}