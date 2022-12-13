<?php
namespace Admin\Config;

use HeaderController;
use BasicController;
use DB;
use Response;
use Lang;
use Input;
use Hash;
use Eloquent;
use Admin\Config\UserDetail;        

class UserController extends BasicController {
    /**
    * Set Model's Repository
    * Set Validatior object
    */
    public function __construct() {
        $this->model = new User();
        //$this->detail = new UserDetailController();
    }
     
    /**
    * Display a listing of the resource.
    * The default list is undeleted list
    * GET apiUrl
    *
    * @return Response
    */
    public function index()
    {
       try {
            $query = DB::table($this->model->getTable())
                    ->select('userId', 'userName', 'roleName', 
                    DB::raw('(CASE WHEN userNonActive = 1 THEN "'.Lang::get('general.yes').'" ELSE "'.Lang::get('general.no').'" END) AS userNonActiveDescription'),
                    DB::raw('(CASE WHEN userRperId > 0 THEN concat("'.Lang::get('user/previewPersonal/').'",userRperId) ELSE concat("'.Lang::get('user/previewInstitute/').'",userRinsId) END) AS urlPreview'))
                    ->leftJoin('role', 'userRolhId', '=', 'roleId');
            
           return $this->getDataGrid($query);                
       }catch(Exception $e){
           return Response::exception($e);
       }    
    }    
    
    /**
    * Display the specified resource.
    * GET /admin/master/base/{id}
    *
    * @param  int  $id
    * @return Response
    */
   protected function getShowData($id) {
       $data = (array) DB::table($this->model->getTable())
                ->select('userId','userRolhId', 'userName', 'userFullName', 'userFirstLogin',
                'userValidityStart', 'userValidityEnd', 
                'userLanguage', 'userFingerPrintId', 'userNonActive',
                DB::raw('DATE_FORMAT(userLastLogin, "%d/%m/%Y %h:%i") AS userLastLogin'),
                DB::raw('DATE_FORMAT(userLastPasswordChange, "%d/%m/%Y %h:%i") AS userLastPasswordChange'))
               ->where ($this->model->getKeyName(),'=', $id)
               ->first();
       
       return $data;
   }
   
   /**
    * Encrypt password before saving data
    * 
    */
   public function beforeStore()
   {
        if(Input::get('userPassword')){
            $pass = Hash::make(Input::get('userPassword'));
            Input::merge(array('userPassword' => $pass));
            
            $user = new \User;
            $user->username = Input::get('userName');
            $user->password = $pass;
            $user->save();
        }
   }
   
   /**
    * Encrypt password before update data
    * 
    */
   public function beforeUpdate()
   {
        if(Input::get('userId')){
          $company = UserDetail::where('uscoUserId','=',Input::get('userId'))->get();
          if(count($company)==0){
              $comp= new UserDetail;  
              $comp->uscoUserId =  Input::get('userId');
              $comp->uscoCompId =  Input::get('uscoCompId');
              $comp->save();          
          }else{
            
          }   
        }
   }
}