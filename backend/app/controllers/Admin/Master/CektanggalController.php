<?php
namespace Admin\Master;

use BasicController;
use DB;
use Lang;
use Input;

class CektanggalController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function index(){
           $param=Input::all();        
           $tanggal=$param['tanggal'];
           $qr=DB::table('company')->select(DB::raw("cektanggal('$tanggal') as res"))->limit(1)->get();
           return json_encode($qr[0]->res);
     }
}