<?php
namespace Admin\Kinerja;

use BasicController;
use DateTime;
use DB;
use Lang;
use Input;
use Session;

class ApprovalcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     // public function __construct() {
      // $this->model = new \Admin\Master\Administrasi();
     // }
    public function index(){
          $data = array(
                         array(
                               "id"=>"0",
                               "kode"=>"0",
                               "nama"=>"Diterima",
                               "text"=>"Diterima",
                               ),
                         array(
                               "id"=>"1",
                               "kode"=>"1",
                               "nama"=>"Proses",
                               "text"=>"Proses",
                               ),
                         array(
                               "id"=>"2",
                               "kode"=>"2",
                               "nama"=>"Terlaksana",
                               "text"=>"Terlaksana",
                               ),
                         );
          return $data;
    }
}