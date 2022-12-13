<?php
namespace Admin;

use BasicController;
use DB;
use Lang;

class ApilistController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Apilist();
     }


}