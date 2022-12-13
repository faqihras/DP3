<?php
namespace Admin\Master;

use BasicController;
use DB;
use Lang;
use Input;
use Hash;
use Eloquent;

class MobileuserController extends BasicController {
    /**
     * Set Model's Repository
     */
    public function __construct() {
         $this->model = new Mobileuser();
    }
    public function index(){


           $param=Input::all();        
           $search=!empty($param['search']['value'])?$param['search']['value']:'';

            $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->orwhere('userName','like','%'.$search.'%')
                    ;
           return $this->getDataGrid($query);                
    }

    public function beforeStore(){
        if(Input::get('userPassword')!=''){
            $pass = Hash::make(Input::get('userPassword'));
            Input::merge(array('userPassword' => $pass));
        }
    }

}