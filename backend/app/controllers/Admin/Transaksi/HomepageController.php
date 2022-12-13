<?php
namespace Admin\Transaksi;

use BasicController;
use DB;
use Lang;
use Input;

class HomepageController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Homepage();
     }
     public function index(){
            $query = DB::table($this->model->getTable())
                    ->select('hpid','hpNama')
                    ;
            
           return $this->getDataGrid($query);                

     }
}