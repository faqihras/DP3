<?php
namespace Admin\Master;

use BasicController;
use DB;
use Lang;
use Input;
use Date;
use Session;

class DeleteuserController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function index(){
           $param   = Input::all();
           $data       = json_decode($_GET['data']);
           // $skpd = Session::get('skpd');
           // $kode = $data->id_barang;
           // $harga = $data->harga;
           $id = $data->id;


           try {
                $query = DB::table('admin_users')
                        ->where('ausrId','=',$id)
                        ->delete();

                return $query;
                 
           }catch(Exception $e){
               return Response::exception($e);
        }
    }
}