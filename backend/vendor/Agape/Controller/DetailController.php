<?php
/**
 * Detail transaction controller 
 * 
 */
namespace Agape\Controller;

use Response;
use DB;
use Session;
use Schema;

class DetailController extends BasicController {
    /**
    * Update the specified resource in storage.
    *
    * @param  int  $headerId
    * @return Response
    */
    public function update($headerId) {
        try {
            $inputId = array();
            $input = parent::getRequestPayload();
            $dbData = $this->getDetailId($headerId);

            foreach ($input as $key => $data) {
                if(empty($data)) {
                    continue; 
                }
                
                if($this->model->usesCompanyStamps()){
                    $data[$this->model->getCompanyField()] = Session::get('companyId');
                }

                if(isset($data[$this->model->getKeyName()])){
                    unset($data[$this->model->getKeyName()]);
                }
                
                if(isset($data[$this->model->getDetailKey()])){
                    if($data[$this->model->getDetailKey()] != $key){
                        continue; 
                    }
                }
                
                $data[$this->model->getHeaderKey()] = $headerId;
                $data[$this->model->getDetailKey()] = $key;

                if(array_search($key, $dbData) !== false){
                    // update
                    $this->model
                        ->where($this->model->getHeaderKey(), $headerId)
                        ->where($this->model->getDetailKey(), $key)
                        ->where($this->model->getDeletedBy())
                        ->update($data);
                } else {
                    // insert
                    $this->model->create($data);
                }
                $inputId[] = $key;
            }

            //delete
            $this->delete($headerId, $inputId);
        
            $result = Response::message(3);
            $result['data'] = null;            
            
            return Response::json($result);
        }catch(Exception $e){
            $error = Response::message(106);
            $error['status']['exception'] = $e;
            return $error;
        }  
    }
    
    /**
    * Remove the specified resource from storage.
    * Soft Delete. Mark delete_at and deleted_by column
    *
    * @param  int  $id parameter Id can be id collective (1,2,3) or single id (1)
    * @return Response
    */
    public function destroy($id)
    {
        $this->model->setKeyName($this->model->getHeaderKey());
        return parent::destroy($id);
    }
    
    /**
     * Remove specific data based on header id and not in input id
     * @param int $headerId
     * @param array $inputId
     * @return array
     */
    public function delete($headerId, $inputId) {
        $model = $this->model;
        $query = $model->getNewQuery()
                ->where($model->getHeaderKey(), $headerId)            
                ->where($model->getDeletedBy());
        
        if(!empty($inputId)){
            $query = $query
                    ->whereNotIn($model->getDetailKey(), $inputId);
        }
        
        $model->setSoftDeleteQuery($query);
        $result = $model->runSoftDelete();
        return $result;
    }
    
    /**
     * Get detail id from db which match with header Id
     * 
     * @param type $headerId
     * @return type
     */
    public function getDetailId($headerId) {
        $idArray = array();
        $query = DB::table($this->model->getTable())
                ->select(DB::raw("group_concat(".$this->model->getDetailKey().") as id"))
                ->where($this->model->getHeaderKey(), $headerId)
                ->groupBy($this->model->getHeaderKey());
        
        if($this->model->usesCompanyStamps()){
            $query = $query->where($this->model->getCompanyField(),'=', Session::get('companyId'));
        }
        
        $deleted_by = $this->model->getDeletedBy();
        if (Schema::hasColumn($this->model->getTable(), $deleted_by))
        {
            $query = $query->where($deleted_by);
        }
        
        $query = $query->first();
        
        if($query){
            $idArray = explode(",", $query->id);
        }
        
        return $idArray;        
    }
    
    /**
    * Specify shown data query
    *
    * @param  int  $id
    * @return Response
    */
   protected function getShowData($id) {
       $detailKey = $this->model->getDetailKey();
       $data = DB::table($this->model->getTable())
                ->where($this->model->getHeaderKey(), $id);
       
        if($this->model->usesCompanyStamps()){
            $data = $data->where($this->model->getCompanyField(),'=', Session::get('companyId'));
        }
        
        $deleted_by = $this->model->getDeletedBy();
        if (Schema::hasColumn($this->model->getTable(), $deleted_by))
        {
            $data = $data->where($deleted_by);
        }
        
        $data = $data->get();
       
        $result = array();
        $data = (array) $data;
        
        foreach ($data as $key => $value) {
            $value = (array) $value;
            $result[$value[$detailKey]] = $value;
        }
        
        $result = json_encode($result);
//        $result = $result;
       return $result;
   }
}