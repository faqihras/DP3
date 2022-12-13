<?php  
namespace Admin\Setup;

use BasicController;
use Input;
use DB;

class CompanyController extends BasicController {
    /**
     * Set Model's Repository
     */
    public function __construct() {
         $this->model = new Company();
//         $this->validator = new ReligionValidator();

    }

    public function index()
	{
		try {
            $query = DB::table($this->model->getTable());
                    //->select('compId', 'compNick', 'compName','compEmail');
           		
           return $this->getDataGrid($query);                
       }catch(Exception $e){
           return Response::exception($e);
       }

	}
}