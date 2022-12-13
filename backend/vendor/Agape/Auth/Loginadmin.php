<?php
/**
 * Auth Login
 */
namespace Agape\Auth;

use DB;
use Session;
use Auth;
use Hash;

class Loginadmin {
    
    public function authentication($user)
    {
        $userDb = $this->attemp($user);

//        if(($userDb == false)or(empty($userDb))){
//            return 1193; //wrong id or password
//        }

        if(empty($userDb)){

            $now=Session::get('userWrongInput');
            $now=$now+1;
            Session::put('userWrongInput',$now);

            if(Session::has('userWrongInput')){
                if(Session::get('userWrongInput')<=2){
                    Session::put('chaptSession',0);
                    return 119; //wrong id or password
                }elseif(Session::get('userWrongInput')==6){
                    // DB::update('update admin_users set ausrBannedTime = "'.date('Y-m-d h:i:s').'" where ausrUsername ="'.$user['username'].'" ');
                    Session::put('chaptSession',0);
                    return 9999;
                }

                if(Session::get('userWrongInput')>2){
                    Session::put('chaptSession',1);
                    return 400;
                }
            }else{

                Session::put('userWrongInput',1);
                Session::put('chaptSession',0);
                return 119; //wrong id or password
            }
        }



        
        $id = $userDb['ausrId'];
        
        if($userDb['ausrActive'] != 0){
            return 118; //inactive user
        }

        /*
        $start = date_parse($userDb['userValidityStart']);
        $end = date_parse($userDb['userValidityEnd']);
        
        $today = new \DateTime(); // Today
        $dateBegin = new \DateTime($start['year'].'-'.$start['month'].'-'.$start['day']);
        $dateEnd  = new \DateTime($end['year'].'-'.$end['month'].'-'.$end['day']);

        if ($today->getTimestamp() >= $dateBegin->getTimestamp() && 
            $today->getTimestamp() <= $dateEnd->getTimestamp()){
            //
        }else{
           return 121; //login out of allowed time
        }
        */

        $companyList = 0;
        
        $comp = $this->getCompanyUser($userDb['ausrId']);
        if(count($comp) > 1){
            $companyList = 1;
        }

        

        if($companyList == 0 && $userDb['ausrFirstLogin'] == 0){

            // DB::update('update admin_users set ausrBannedTime = "0000-00-00 00:00:00" where ausrUsername ="'.$user['username'].'" ');
            Session::put('userWrongInput',0);

            $userDb['modul']=$user['modul'];
            $userDb['thnang']=$user['thnang'];
            $this->setSession($userDb, $comp);
//            Auth::attempt($user);

        } else {
            Session::put('tempUserIdAdmin', $id);
            Session::put('tempPwAdmin', $user['password']);
            Session::put('userFirstLoginAdmin', $userDb['ausrFirstLogin']);
            Session::put('companyListAdmin', $companyList);
            Session::put('userRolhIdAdmin', $userDb['ausrRolhId']);
        }

        
        $result = array( 'data' => array(
            'userFirstLoginAdmin' => $userDb['ausrFirstLogin'],
            'companyListAdmin' => $companyList
        ));
        
        // update last login date
        $this->updatelastLogin($id);
        return $result;
    }
    
    public function attemp($user) 
    {
        $data = (array) DB::table('admin_users')
                ->where('ausrUsername', '=', trim($user['username']))
                ->first();
        
        if(empty($data)){
            return false;
        }
        
        if (!Hash::check($user['password'], $data['ausrPassword'])) 
        {
            return false;
        }
        
        return $data;
    }
    
    public function getUser($userId)
    {
        $data = (array) DB::table('admin_users')
                ->where('ausrId', '=', $userId)
                ->first();
        return $data;
    }
    
    private function getCompanyUser($id)
    {
        $query = (array) DB::table('admin_company')
                ->select('compId','compName','compCity','compStatusAnggaran','compKlinikId')
                ->leftJoin('company', 'compId', '=', 'adcoCompId')
                ->where('adcoAdmnId', $id)
                ->get();

        return $query;
    }
    
    public function getCompany()
    {
        $query = DB::table('company')
                ->select('compId','compName','compCity','compStatusAnggaran','compKlinikId')
                ->where('compId', '=', DB::raw(Session::get('companyIdAdmin')))
                ->first();
        return $query;
    }
    
    public function setSession($userDb, $comp){
        //Session::put('companyId', $comp->compId);
        Session::put('companyIdAdmin', !empty($comp[0]->compId)? $comp[0]->compId:'1' );
        Session::put('companyNameAdmin', !empty($comp[0]->compName)? $comp[0]->compName:' ' );
        Session::put('city', !empty($comp[0]->compCity)? $comp[0]->compCity:'' );
        Session::put('compStatusAnggaran', !empty($comp[0]->compStatusAnggaran)? $comp[0]->compStatusAnggaran:'1' );
        Session::put('userIdAdmin', $userDb['ausrId']);
        //Session::put('userId', $userDb['userId']);
        Session::put('userNameAdmin', $userDb['ausrUsername']);
        Session::put('userNameAdminLong', $userDb['ausrName']);
        Session::put('userRolhIdAdmin', $userDb['ausrRolhId']);
        Session::put('admin', '1');
        Session::put('modul', $userDb['modul']);
        Session::put('tahun', $userDb['thnang']);
        Session::put('unit', $userDb['ausrUnit']);
        //Klinik ID
        Session::put('userKlinikId', $userDb['ausrKlinikId']);

    }
    
    private function updateLastLogin($userId){
        if($userId > 0){
            $input = array( 'ausrLastLogin' => date('Y-m-d H:i:s'));
            DB::table('admin_users')
                    ->where('ausrId', '=', $userId)
                    ->update($input);
        }
    }
}
