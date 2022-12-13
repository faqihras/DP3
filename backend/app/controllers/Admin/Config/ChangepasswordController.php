<?php
namespace Admin\Config;

use Response;
use Validator;
use Input;
use Controller;
use DB;
use Session;
use Hash;

class ChangepasswordController extends Controller {
    
    /**
     * Change user name password.
     * 3 inputs = old_password, password, password_confirmation, form with action=post. 
     * Validator check requirements, hash checks if Old password matches
     * 
     * @return json
     */
    public function store()
    {
        $rules = array(
            'oldPassword' => 'required',
            'newPassword' => 'required'
//            'newPassword' => 'required|alphaNum|confirmed'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) 
        {
            return Response::message(115);
        } 
        else 
        {
            if (Session::has('userIdAdmin'))
            {
                $id = Session::get('userIdAdmin');
            } else if (Session::has('tempUserId'))
            {
                $id = Session::get('tempUserId');
            } else {
                return Response::message(400);
            }

            
            $user = DB::table('admin_users')->where('ausrId', $id)->first();
            if (!Hash::check(Input::get('oldPassword'), $user->ausrPassword)) 
            {
                return Response::message(129);
            }else{
                $password = array(
                   // 'userLastPasswordChange' => date('Y-m-d H:i:s'),
                    'ausrPassword' => Hash::make(Input::get('newPassword')) );
                DB::table('admin_users')->where('ausrId', $id)->update($password);
                
                Session::put('ausrFirstLogin', 0);
                
                $result = Response::message(11);
                if (Session::has('companyList')){
                    $result['data'] = array(
                        'ausrFirstLogin' => 0,
                        'companyList' => Session::get('companyList')
                    );
                }

                return $result;
            }
        }
    }
}
