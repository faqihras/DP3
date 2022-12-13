<?php
namespace Agape\Inventory\Traits;

use Schema;
use DB;
use Auth;

trait ReceiptTrait{    
    /**
    * Set Receipt Prefix value
    *
    * @var string
    */
   protected $receiptPrefix = 'REF';
   
   /**
    * Reset No receipt each year setting
    *
    * @var bool
    */
   protected  $resetEachYear = true;
   
   /**
    * Reset No receipt each month setting
    *
    * @var bool
    */
    protected  $resetEachMonth = true;
    
    /**
    * Receipt will be stamp when status equals 1
    *
    * @var string
    */
    protected $receiptStatus = 1;
    
    /**
     * Receipt stamps activation
     * 
     * @var bool 
     */
    protected $receiptStamps = true;
    
    /**
     * Get Receipt status value
     * 
     * @return int
     */
    public function getReceiptStatus() {
        return $this->receiptStatus;
    }
    
    /**
     * Get latest receipt number on table's model
     * 
     * @return string
     */
    public function getLastReceipt(){
        $col = $this->tablePrefix ."RefNo";
        $data = '';
        if (Schema::hasColumn(parent::getTable(), $col))
        {
            $query = (array) DB::table(parent::getTable())
                ->select($col)
                ->where($col, '!=', '""')
                ->orderBy($col, "desc")
               ->first();
            
            if($query){
                $data = $query[$col];
            }
        } else {
            $data = 'error';
        }
        return $data;
    }
    
    /**
     * Generate next receipt number
     * 
     * @return string
     */
    public function getReceipt() {
        $lastcode = $this->getLastReceipt();
        if($lastcode == 'error') {
            return 'error';
        }
        
        if ($lastcode=='') {
            $refNo = $this->receiptPrefix.date('Ym').'0001';            
        }else{
            $lastno = intval(substr($lastcode,-4));
            $month = substr($lastcode,-6,2);
            $year = substr($lastcode,-10,4);
            
            $refNo = $this->receiptPrefix.date('Ym').sprintf('%04d',($lastno+1));
        
            if($this->resetEachYear && $year!=date('Y')) {
                $refNo = $this->receiptPrefix.date('Ym').'0001';
            }
            if($this->resetEachMonth && $month!=date('m')) {
                $refNo = $this->receiptPrefix.date('Ym').'0001';
            }
        }
        return $refNo;
    }
    
    /**
     * Update receipt number based on primary key table
     * 
     * @param int $id primary key id
     * @return int
     */
    public function runReceipt($id) {
        if(!$this->receiptStamps) {
            return;
        }
        
        $no = $this->getReceipt();
        if($no == 'error') {
            return;
        }
        
        $userId = 0;

        if (Auth::check())
        {
            $userId = Auth::user()->id;
        } else {
            return 400;
        }
        
        $data[$this->tablePrefix . 'RefNo'] = $no;
        
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
}
