<?php
namespace Agape\Inventory\Models;

class TransactionModels extends \Agape\Models\BasicModels {    
    
    use \Agape\Inventory\Traits\ReceiptTrait,
        \Agape\Inventory\Traits\TransactionStampsTrait;
    
    public $noSeqKey = null;
    
    public function getNoSeqKey(){
        if($this->noSeqKey == null){
            $this->noSeqKey = $this->tablePrefix."NoSeq";
        }
        return $this->noSeqKey;
    }
}
