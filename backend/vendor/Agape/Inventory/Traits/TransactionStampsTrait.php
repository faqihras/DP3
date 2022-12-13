<?php
namespace Agape\Inventory\Traits;

use Auth;
use Input;

trait TransactionStampsTrait {    
    
    /**
    * Prefix of table column name
    *
    * @var string
    */
    protected $tablePrefix = '';
    
    /**
     * Status column name
     * 
     * @var string
     */
    protected $statusColumn = null;
    
    /**
     * Void column name
     * 
     * @var string
     */
    protected $voidColumn = null;
    
    /**
     * Confirmation stamps activation
     * @var bool
     */
    protected $confirmStamps = true;
    
    /**
     * Approval stamps activation
     * 
     * @var bool
     */
    protected $approvalStamps = true;
    
    /**
     * Void stamps activation
     * 
     * @var bool
     */
    protected $voidStamps = true;
    
    /**
     * Confirmation stamps will be added if statusColumn has same value
     * 
     * @var int
     */
    protected $confirmStatus = 1;
    
    /**
     * Approval stamps will be added if statusColumn has same value
     * 
     * @var int
     */
    protected $approvalStatus = 2;
    
    /**
     * Void stamps will be added if statusColumn has same value
     * 
     * @var int
     */
    protected $voidStatus = 1;
   
    /**
     * Get confirmation status
     * 
     * @return bool
     */
    public function getConfirmStatus() {
        return $this->confirmStatus;
    }
    
    /**
     * Get Approval status
     * 
     * @return bool
     */
    public function getApprovalStatus() {
        return $this->approvalStatus;
    }
    
    /**
     * Get Void status
     * 
     * @return bool
     */
    public function getVoidStatus() {
        return $this->voidStatus;
    }
    
    /**
     * Get Status column name 
     * Status column equals tablePrefix+Status if null 
     * 
     * @return type
     */
    public function getStatusColumn() {
        if($this->statusColumn == null){
            $this->statusColumn = $this->tablePrefix."Status";
        }
        return $this->statusColumn;
    }
    
    /**
     * Get Void column name 
     * Void column equals tablePrefix+Status if null 
     * 
     * @return type
     */
    public function getVoidColumn() {
        if($this->voidColumn == null){
            $this->voidColumn = $this->tablePrefix."Void";
        }
        return $this->voidColumn;
    }
    
    /**
     * Get prefix of table column name
     * @return string
     */
    public function getTablePrefix() {
        return $this->tablePrefix;
    }
    
    /**
     * This transaction has been void. So, update appropriate void data,
     * such as: Void, VoidUserId, VoidTime, VoidReason
     * 
     * @param type $id
     * @return int
     */
    public function runVoid($id) {
        if(!$this->voidStamps) {
            return;
        }
        
        $userId = 0;

        if (Auth::check())
        {
            $userId = Auth::user()->id;
        } else {
            return 400;
        }
        
        $data = array();
        $data[$this->tablePrefix . 'Void'] = 1;
        $data[$this->tablePrefix . 'VoidUserId'] = $userId;
        $data[$this->tablePrefix . 'VoidTime'] = date('Y-m-d H:i:s');
        $data[$this->tablePrefix . 'VoidReason'] = Input::get($this->tablePrefix . 'VoidReason');
        
        $result = $this->newQuery()
                ->where($this->getKeyName(),'=', $id)
                ->update($data);
        
        if($result > 0){
            return 2;
        } else if($result == 0){
            return 19;
        }
        return 183;
    }
    
    /**
     * This transaction has been confirmed. So, update appropriate confirmed data,
     * such as: ConfirmUserId, ConfirmTime
     * 
     * @return array
     */
    public function runConfirm($id) {
        if(!$this->confirmStamps) {
            return;
        }
        
        $userId = 0;

        if (Auth::check())
        {
            $userId = Auth::user()->id;
        } else {
            return 400;
        }
        
        $data[$this->tablePrefix . 'Status'] = $this->confirmStatus;
        $data[$this->tablePrefix . 'ConfirmUserId'] = $userId;
        $data[$this->tablePrefix . 'ConfirmTime'] = date('Y-m-d H:i:s');
        
        $result = $this->newQuery()
                ->where($this->getKeyName(),'=', $id)
                ->where($this->tablePrefix . 'Status','=', $this->confirmStatus)
                ->update($data);
        
        if($result > 0){
            return 2;
        } else if($result == 0){
            return 19;
        }
        return 183;
    }
    
    /**
     * This transaction has been approved. So, update appropriate approved data,
     * such as: ApprovedUserId, ApprovedTime
     * 
     * @return array
     */
    public function runApproval($id) {
        if(!$this->approvalStamps) {
            return;
        }
        
        $userId = 0;

        if (Auth::check())
        {
            $userId = Auth::user()->id;
        } else {
            return 400;
        }
        
        $data[$this->tablePrefix . 'Status'] = $this->approvalStatus;
        $data[$this->tablePrefix . 'ApprovedUserId'] = $userId;
        $data[$this->tablePrefix . 'ApprovedTime'] = date('Y-m-d H:i:s');
        
        $result = $this->newQuery()
                ->where($this->getKeyName(),'=', $id)
                ->where($this->tablePrefix . 'Status','=', $this->approvalStatus)
                ->update($data);
        
        if($result > 0){
            return 2;
        } else if($result == 0){
            return 19;
        }
        return 183;
    }
}
