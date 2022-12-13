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
use Useradmin;
        
class UseradminController extends BasicController {
    /**
    * Set Model's Repository
    * Set Validatior object
    */
    public function __construct() {
        $this->model = new Useradmin();
       // $this->detail = new UserDetailController();
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
      

       $param=Input::all();        
       $search=$param['search']['value'];

       try {
            $query = DB::table($this->model->getTable())
                    //->leftJoin('role_menu', 'admin_users.ausrRolhId', '=', 'role_menu.rolmRoleId')
                    ->select('ausrId', 'ausrUsername','ausrName', 'ausrRolhId','roleName','ausrRolhId','ausrUnit', 
                    DB::raw('(CASE WHEN ausrActive = 1 THEN "'.Lang::get('general.yes').'" ELSE "'.Lang::get('general.no').'" END) AS userNonActiveDescription'))
                    ->leftJoin('role', 'ausrRolhId', '=', 'roleId')
                    ->where('ausrUsername','like','%'.$search.'%');
            
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
                ->select('ausrId','ausrUsername','ausrName', 'ausrActive', 'ausrRolhId','ausrPassword','ausrUnit',
                DB::raw('DATE_FORMAT(ausrLastLogin, "%d/%m/%Y %h:%i") AS ausrLastLogin'),
                DB::raw('DATE_FORMAT(ausrCreated, "%d/%m/%Y %h:%i") AS ausrCreated'))
               ->where ($this->model->getKeyName(),'=', $id)
               ->first();
       $data['ausrPassword']='';
       return $data;
   }
   
   /**
    * Encrypt password before saving data
    * 
    */
   public function beforeStore()
   {
        if(Input::get('ausrPassword')){
            $pass = Hash::make(Input::get('ausrPassword'));
            Input::merge(array('ausrPassword' => $pass));
            
            /*$user = new \Useradmin;
            $user->ausrUsername = Input::get('ausrUsername');
            $user->ausrPassword = $pass;
            $user->save();*/
        }
   }
   
   /**
    * Encrypt password before update data
    * 
    */
   public function beforeUpdate()
   {
        if(Input::get('ausrPassword')){
            $pass = Hash::make(Input::get('ausrPassword'));
            
            /*$user = \Useradmin::find(Input::get('ausrId'));
            $user->ausrUsername = Input::get('ausrUsername');
            $user->ausrPassword = $pass;
            $user->save();*/
            
            Input::merge(array('ausrPassword' => $pass));
        }
   }
}