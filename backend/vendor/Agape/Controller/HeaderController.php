<?php
/**
 * Header transaction controller 
 * 
 */
namespace Agape\Controller;

use Response;
use Input;
use DetailController;

class HeaderController extends BasicController {
   /**
     * Detail controller
     * 
     * @var Object Admin\Authentication\RoleDetailController
     */
    protected $detail = null;
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
   public function show($id)
   {
       try {
            $result = parent::show($id);
           
            if($result['status']['error'] == 0){
                $details = $this->detail->getShowData($id);
                $result['data']['detail'] = $details;
            } 
           
           return $result;
       }catch(Exception $e){
           return Response::exception($e);
       } 
   }
  
    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
   public function update($id)
   {
        $result = array();
        $formdata = Input::all();
        
        if(!empty($formdata)){
            $result = parent::update($id);
        }
        
        $request = parent::getRequestPayload();
        if(!empty($request)){
            $result = $this->detail->update($id);
        } 
        
        return $result;
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
        $result = $this->detail->destroy($id);
        
        if($result['status']['error'] == 0){
            $result = parent::destroy($id);
        } 
        return $result;
    }
    
}