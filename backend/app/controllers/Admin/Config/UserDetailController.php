<?php
namespace Admin\Config;

use DetailController;

class UserDetailController extends DetailController {
    /**
    * Set Model's Repository
    * Set Validatior object
    */
    public function __construct() {
        $this->model = new UserDetail();
    }    
}