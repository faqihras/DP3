<?php
/**
 * Header transaction controller 
 * 
 */
namespace Agape\Inventory\Controllers;

class DetailTransactionController extends \Agape\Controller\DetailTransactionController {
    
    protected $columns = array();
    protected $totalQty = 0;
    protected $totalAmount = 0;
    
    /**
      * Calculate detail data
      */
    protected function calcTransactionRequests() {
        $data = parent::getRequestPayload();
        
        if(empty($this->columns)){
            return $data;
        }
        
        if(is_numeric(key($data))){
            foreach ($data as $key => $input) {
                if(empty($input)) {
                    continue; 
                }
                $data[$key] = $this->calcTransaction($input, $this->columns);                
            }
        } else {
            $data = $this->calcTransaction($data, $this->columns);
        }
        
        return $data;
    }
    
    
    protected function calcTransaction($input, $columns) {
        $price = isset($columns['price'])? $columns['price'] : null;
        $qty = isset($columns['qty'])? $columns['qty'] : null;
        $subtotal = isset($columns['subtotal'])? $columns['subtotal'] : null;
        $discPercent = isset($columns['discPercent'])? $columns['discPercent'] : null;
        $disc = isset($columns['disc'])? $columns['disc'] : null;
        $taxPercent = isset($columns['taxPercent'])? $columns['taxPercent'] : null;
        $tax = isset($columns['tax'])? $columns['tax'] : null;
        $total = isset($columns['total'])? $columns['total'] : null;
        
        $taxVal = $discVal = 0;
        $subtotalVal = $input[$price] * $input[$qty];
        $totalVal = $subtotalVal;
        
        if ($discPercent && isset($input[$discPercent])) {
            $discArr = explode('+', $input[$discPercent]);
            foreach ($discArr as $value) {
                $d = $totalVal * ($value/100);
                $totalVal -= $d;
                $discVal += $d;
            }
        } else {
            $input[$discPercent] = 0;
        }

        if ($taxPercent && isset($input[$taxPercent])) {
            $taxVal = $totalVal * ($input[$taxPercent] / 100);
            $totalVal = $totalVal + $taxVal;
        } else {
            $input[$taxPercent] = 0;
        }
        
        $this->totalAmount += $totalVal;
        $this->totalQty += $input[$qty];
        
        $input[$subtotal] = $subtotalVal;
        $input[$disc] = $discVal;
        $input[$tax] = $taxVal;
        $input[$total] = $totalVal;
        
        return $input;
   }
    
    protected function getTotalAmount() {
        return $this->totalAmount;
    }
    
    protected function getTotalQty() {
        return $this->totalQty;
    }
    
    protected function jsonEncode($data) {
        if(empty($this->columns)){
            return json_encode($data);
        }
        
        foreach ($data as $id => $columns) {
            foreach($this->columns as $key => $value){
                if($key == 'discPercent') {
                    continue;
                }
                if(isset($data[$id][$value])){
                    $data[$id][$value] = intval($data[$id][$value]);
                }
            }
        }
        
        return json_encode($data);
    }
}