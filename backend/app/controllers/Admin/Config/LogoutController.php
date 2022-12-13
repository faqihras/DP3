<?php
namespace Admin\Config;

use Auth;
use Controller;
use Session;
use Redirect;

class LogoutController  extends Controller {
    
    public function index() 
    {
        //Auth::logout(); 
        //Session::flush();
        
        Session::forget('companyIdAdmin');
        Session::forget('companyNameAdmin');
        Session::forget('userIdAdmin');
        Session::forget('userNameAdmin');
        Session::forget('userRolhIdAdmin');
        Session::forget('admin');

        $datas = Session::all();

        $stat=true;
        $forget=0;
        foreach($datas as $data => $key){

            if($data=='companyId'){
                $forget=1;
            }else if($data=='companyName'){
                $forget=1;
            }else if($data=='userId'){
                $forget=1;
            }else if($data=='userName'){
                $forget=1;
            }else if($data=='userRolhId'){
                $forget=1;
            }else if($data=='user'){
                $forget=1;
            }else if($data=='companyIdUser'){
                $forget=1;
            }else if($data=='companyNameUser'){
                $forget=1;
            }else if($data=='userIdUser'){
                $forget=1;
            }else if($data=='userNameUser'){
                $forget=1;
            }else if($data=='userRolhIdUser'){
                $forget=1;
            }

            if($forget==0){
                Session::forget($data);
            }
            
            $forget=0;
        }

        return array('status'=>'Logout Sukses');
        //return Redirect::to('admin'); 
    }
}