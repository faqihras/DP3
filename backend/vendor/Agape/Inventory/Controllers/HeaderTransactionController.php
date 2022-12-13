<?php
/**
 * Header transaction controller 
 * 
 */
namespace Agape\Inventory\Controllers;

use Input;
use \Agape\Auth\Permission as Permit;

class HeaderTransactionController extends \Agape\Controller\HeaderTransactionController {
    
    /**
     * Run this function after save data
     * 
     * @param int $id primaryKey
     */
    public function afterStoreSuccess($id) {
        $this->setInputStamps($id);
    }
    
    /**
     * Run this function after update data
     * 
     * @param int $id primaryKey
     */
    public function afterUpdate($id) {
        $this->setInputStamps($id);
    }
    
    /**
     * Update transaction stamps
     * 
     * @param int $id primaryKey
     */
    public function setInputStamps($id) {
        $void = Input::get($this->model->getVoidColumn());
        
        //void stamps
        if($void == $this->model->getVoidStatus()) {
            $this->model->runVoid($id);
        } else {
            $status = Input::get($this->model->getStatusColumn());
            
            //confirm stamps
            if($status == $this->model->getConfirmStatus()) {
                $this->model->runConfirm($id);
            }

            //approve stamps
            if($status == $this->model->getApprovalStatus()) {
                $this->model->runApproval($id);
            }

            //receipt stamps
            if($status == $this->model->getReceiptStatus()) {
                $this->model->runReceipt($id);
            }
        }
    }
    
    /**
    * Update the specified resource in storage.
    * PUT api url/{id}
    *
    * @param  int  $id
    * @return Response
    */
   public function update($id)
   {
        $permit = $this->checkPermission();
        $result = null;
        if($permit == 0){
            $result =parent::update($id);
        } else {
            $result = $permit;
        }
        return $result;
    }
    
    /**
    * Store a newly created resource in storage.
    * POST /admin/master/base
    * 
    * @return Response
    */
    public function store()
    {
        $permit = $this->checkPermission();
        $result = null;
        if($permit == 0){
            $result =parent::store();
        } else {
            $result = $permit;
        }
        return $result;
    }
    
    /**
     * Check permisiion confirm, void, approval
     * 
     * @return obj
     */
    public function checkPermission() {
        $void = Input::get($this->model->getVoidColumn());
        
        //void stamps
        if($void == $this->model->getVoidStatus()) {
            if(!Permit::void($this->menuLink)){
                return Response::message(144); 
            }
        } else {
            $status = Input::get($this->model->getStatusColumn());
            
            //confirm stamps
            if($status == $this->model->getConfirmStatus()) {
                if(!Permit::confirm($this->menuLink)){
                    return Response::message(144); 
                }
            }

            //approve stamps
            if($status == $this->model->getApprovalStatus()) {
                if(!Permit::confirm($this->menuLink)){
                    return Response::message(144); 
                }
            }
        }
        
        return 0;
    }
}