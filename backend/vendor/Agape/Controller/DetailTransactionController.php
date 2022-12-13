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
use Input;

class DetailTransactionController extends BasicController {
   /**
    * No sequence will be reordered after delete data
    *
    * @var bool
    */
   public $reorderNoSeq = true;
   
   /**
    * Display a listing of the resource based on its headerId parameter.
    * The default list is undeleted list.
    *
    * @return Response
    */
   public function index()
   {
       try {
           $newData = array();
           $detailKey = $this->model->getDetailKey();
           
           $query = $this->getIndexData();
           
           $result = $this->getDataGrid($query);
           
           $data = $result['data'];
           
           foreach ($data as $key => $value) {
                $value = (array) $value;
                $newData[$value[$detailKey]] = $value;
            }
        
            if(empty($newData)){
                $result['data'] = "{}";
            } else {
                $result['data'] = $this->jsonEncode($newData);
            }
           return $result;                
       }catch(Exception $e){
           return Response::exception($e);
       }    
   }
   
   /**
    * Display the index resource.
    *
    * @return Response
    */
   protected function getIndexData()
   {
        $query = DB::table($this->model->getTable())
                   ->where($this->model->getHeaderKey(),"=",Input::get('headerId'))
                   ->orderBy($this->model->getDetailKey(), 'asc');
        return $query;
   }
   
   /**
    * Display the specified resource.
    * GET /admin/master/base/{id}
    *
    * @param  int  $id
    * @return Response
    */
   public function show($id)
   {
        $result = parent::show($id);
        
        $detailKey = $this->model->getDetailKey();
        
        $result['data']['id'] = $id;
        $newData = array($result['data'][$detailKey] => $result['data'] );
        
        $result['data'] = $this->jsonEncode($newData);
        
        return $result;
   }
   
   /**
    * Store the specified resource in storage.
    *
    * @param  int  $headerId
    * @return Response
    */
    public function store() {
        try {
            $data = parent::getRequestPayload();
            $result = array();
            
            if (method_exists($this, 'beforeStore'))
            {
                $data = $this->beforeStore();
                if($data == null){
                    $result = Response::message(108);
                    $result['data'] = null;
                    return $result;
                }
            }
            
            if(is_numeric(key($data))){
                foreach ($data as $key => $input) {
                    if(empty($input)) {
                        continue; 
                    }

                    if($this->model->usesCompanyStamps()){
                        $input[$this->model->getCompanyField()] = Session::get('companyId');
                    }

                    $query = $this->model->create($input);

                    if($query){
                        
                        if (method_exists($this, 'afterStoreSuccess'))
                        {
                            $this->afterStoreSuccess($id);
                        }

                        $id = $query->{$this->model->getKeyName()};
                        $detailKey = $this->model->getDetailKey();
                        
                        $result = Response::message(5);
                        $result['data'] = $this->getShowData($id);
                        $result['data']['id'] = $id;
                        
                        $data = $result['data'];
                        $newData = array($result['data'][$detailKey] => $result['data'] );
                        $result['data'] = $this->jsonEncode($newData);
                    } else {
                        $result = Response::message(107);
                        $result['data'] = null;
                    }
                }
            } else {
               if($this->model->usesCompanyStamps()){
                    $input[$this->model->getCompanyField()] = Session::get('companyId');
                }

                $query = $this->model->create($input);
                
                if($query){
                    $id = $query->{$this->model->getKeyName()};
                    $rows = $this->show($id);
                    $result = Response::message(5);
                    $result['data'] = $rows['data'];
                } else {
                    $result = Response::message(107);
                    $result['data'] = null;
                } 
            }
            
            return $result;
        }catch(Exception $e){
            $error = Response::message(107);
            $error['status']['exception'] = $e;
            return $error;
        }  
    }
    
   /**
    * Update the specified resource in storage.
    * The id parameter is detail id
    *
    * @param  int  $detailId
    * @return Response
    */
    public function update($id) {
        try {
            $data = parent::getRequestPayload();
            $result = array();
            
            if (method_exists($this, 'beforeUpdate'))
            {
                $data = $this->beforeUpdate();
                if($data == null){
                    $result = Response::message(108);
                    $result['data'] = null;
                    return $result;
                }
            }
                
            if(is_numeric(key($data))){
                foreach ($data as $key => $input) {
                    if(empty($input)) {
                        continue; 
                    }

                    if($this->model->usesCompanyStamps()){
                        $input[$this->model->getCompanyField()] = Session::get('companyId');
                    }
                    
                    $id = $input[ $this->model->getKeyName() ];
                    $query = $this->model->find($id)
                            ->update($input);

                    if($query){
                        if (method_exists($this, 'afterUpdateSuccess'))
                        {
                            $this->afterUpdateSuccess($id);
                        }
                        
                        $rows = $this->show($id);
                        $result = Response::message(3);
                        $result['data'] = $rows['data'];
                    } else {
                        $result = Response::message(106);
                        $result['data'] = null;
                    }
                }
                
                if (method_exists($this, 'afterUpdateSuccess'))
                {
                    $this->afterUpdateSuccess($id);
                }
                
            } else {
                if($this->model->usesCompanyStamps()){
                    $input[$this->model->getCompanyField()] = Session::get('companyId');
                }

                $query = $this->model->find($id)
                        ->update($input);
                
                if (method_exists($this, 'afterUpdateSuccess'))
                {
                    $this->afterUpdateSuccess($id);
                }
                
                if($query){
                    $result = Response::message(3);
                    $result['data'] = $this->getShowData($id);
                    $result['data']['id'] = $id;
                    $result['data'] = json_encode($result['data'], JSON_NUMERIC_CHECK);
                } else {
                    $result = Response::message(106);
                    $result['data'] = null;
                }
            }
            
            return $result;
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
        $headerId = 0;
        if($this->reorderNoSeq){
            $headerId = $this->getHeaderId($id);
        }
        
        $result = parent::destroy($id);
        
        if($this->reorderNoSeq && $headerId != 0){
            $this->runReorderNoSeq($headerId);
        }
        
        return $result;
    }
    
    /**
     * Remove specific data based on header id and not in input id
     * @param int $headerId
     * @param array $inputId
     * @return array
     */
    public function delete($id) {
        $this->model->setKeyName($this->model->getHeaderKey());
        return parent::destroy($id);
    }
    
    /**
     * Get header id based on detail id
     * 
     * @param int $id
     * @return int
     */   
    public function getHeaderId($id) {
        $headerId = 0;
        
        $query = (array) DB::table($this->model->getTable())
                ->select($this->model->getHeaderKey())
                ->where($this->model->getKeyName(), $id)
                ->first();
        if($query){
            $headerId = $query[$this->model->getHeaderKey()];
        }
        return $headerId;
    }
    
    /**
     * Reorder number
     * 
     * @param int $id Header Id
     */
    public function runReorderNoSeq($id) {
        $sql = 'SET @i = 0; ';
        DB::statement($sql);
        $sql = ' UPDATE '.$this->model->getTable().
            ' SET '.$this->model->getNoSeqKey().' = @i:=@i+1'.
            ' WHERE '.$this->model->getHeaderKey().' = '. $id.
            ' AND '.$this->model->getDeletedBy().' IS NULL '.
            ' ORDER BY '.$this->model->getNoSeqKey().' ASC';
        DB::statement($sql);
    }
    
    
    protected function jsonEncode($data) {
        return json_encode($data);
    }
}