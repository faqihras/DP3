<?php
namespace Admin\Master;

use BasicController;
use DB;
use Lang;
use Input;
use Session;

class ListController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Lapkerja();
     }

     public function index(){

            $param = Input::all();        
            $idpeg = $param['idreq'];
            $query = DB::table($this->model->getTable())
                     ->select('*')
                     ->where('lkIdPeg','=',$idpeg)
                     ->orderBy('lkTgl', 'desc')
                     ->limit(30)
                     ->get();
            
           return $query;
     }
}