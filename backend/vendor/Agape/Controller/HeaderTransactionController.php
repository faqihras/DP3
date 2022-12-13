<?php
/**
 * Header transaction controller 
 * 
 */
namespace Agape\Controller;

use Response;

class HeaderTransactionController extends BasicController {
    /**
     * Detail controller
     * 
     * @var Object Admin\Authentication\RoleDetailController
     */
    protected $detail = null;
           
    /**
    * Remove the specified resource from storage.
    * Soft Delete. Mark delete_at and deleted_by column
    *
    * @param  int  $id parameter Id can be id collective (1,2,3) or single id (1)
    * @return Response
    */
    public function destroy($id)
    {
        $result = $this->detail->delete($id);
        
        if($result['status']['error'] == 0){
            $result = parent::destroy($id);
        } 
        return $result;
    }
}