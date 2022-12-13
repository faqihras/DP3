<?php
namespace Admin\Config\Userapi;

use ReadDataController;

class RoleController extends ReadDataController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new \Admin\Config\Role();
     }
}