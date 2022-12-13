<?php
/**
 * Base controller 
 * 
 * Validation
 * @see https://github.com/fadion/ValidatorAssistant
 */
namespace Agape\Controller;

use DB;
use Response;
use Input;
use Controller;
use Exception;
use Paginator;
use Schema;
use Session;
use \Agape\Auth\Permission as Permit;

class ReadDataController extends Controller {
        
        /**
         * Repository model object
         * @var type Object Model
         */
        protected $model;
        
        /**
         * Menu Link
         * This contains menuLink of each module
         * @var string menuLink 
         */
        protected $menuLink = null;
        
        /**
	 * Display a listing of the resource.
         * The default list is undeleted list
	 * GET /admin/master/base
	 *
	 * @return Response
	 */
	public function index()
	{
            try {
                if(!Permit::view($this->menuLink)){
                    return Response::message(144); 
                }
                
                $query = DB::table($this->model->getTable());
                return $this->getDataGrid($query);                
            }catch(Exception $e){
                return Response::exception($e);
            }    
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
            try {
                
                if(!Permit::view($this->menuLink)){
                    return Response::message(144); 
                }
                
                $id = $this->checkId($id);
                $data = $this->model->find($id);
                
                // data not found
                if($data == null){
                    $result['data'] = null;
                    $result = array_merge($result, Response::message(103));
                } else {
                    $result['data'] = $data->toArray();
                } 
                
                $result['permission'] = Permit::all($this->menuLink);
                
                return Response::json($result);
            }catch(Exception $e){
                return Response::exception($e);
            }
        }
        
        /**
	 * Get data grid based on specific query.
         * This uses for displaying data grid with customized query.
	 * Developer can customized index() query then send to getDataGrid to 
         * get default return values.
         * 
         * @param DB $query
	 * @return Response
	 */
        protected function getDataGrid($query)
	{
            try {
                
                if(!Permit::view($this->menuLink)){
                    return Response::message(144); 
                }
                
                if($this->model->usesCompanyStamps()){
                    $query = $query->where($this->model->getCompanyField(),'=', Session::get('companyId'));
                }
                $query = $this->showActiveData($query);                
                $query = $this->filters($query);                
                $query = $this->sorting($query);
                $query = $this->paging($query);
                $query['permission'] = Permit::all($this->menuLink);
                
                return Response::json($query);
            }catch(Exception $e){
                return Response::exception($e);
            }
        }
        
        /**
         * Filter grid data result
         * 
         * @param DB $query
         * @return DB
         */
	protected function showActiveData($query)
	{
	    try {
                $deleted_by = $this->model->getDeletedBy();
                if (Schema::hasColumn($this->model->getTable(), $deleted_by))
                {
                    $query = $query->whereNull($deleted_by);
                }
                return $query;
            }catch(Exception $e){
                echo Response::exception($e);
                return $query;
            }
	}
        
        /**
         * Filter grid data result
         * 
         * @param DB $query
         * @return DB
         */
	protected function filters($query)
	{
	    try {
                if(Input::get('searchCol') && Input::get('searchText')){
                    switch(Input::get('searchType')){
                        case 1: 
                            $query = $query->where(Input::get('searchCol'), Input::get('searchText'));
                            break;
                        case 2: 
                            $query = $query->where(Input::get('searchCol'), 'LIKE', '%'.Input::get('searchText').'%');
                            break;
                        case 3: 
                            $query = $query->where(Input::get('searchCol'), 'LIKE', Input::get('searchText').'%');
                            break;
                    }                    
                }
                return $query;
            }catch(Exception $e){
                echo Response::exception($e);
                return $query;
            }
	}
        
        /**
         * Order by Queries
         * 
         * @param DB $query
         * @return DB
         */
	protected function sorting($query)
	{
	    try {
                if(Input::get('order') > 0 && Input::get('sort')){
                    if(Input::get('order') == '2'){
                        $order = 'desc';
                    } else {
                        $order = 'asc';
                    }
                    $query = $query->orderBy(Input::get('sort'), $order);                
                }
                return $query;
            }catch(Exception $e){
                echo Response::exception($e);
                return $query;
            }
	}

        /**
         * Set query for paging the result
         * 
         * @param DB $query
         * @return DB
         */
	protected function paging($query)
	{
	    try {
                if(Input::get('limit') == -1){
                    return array( 'data' => $query->get());
                }
                    
                if($this->model->getPerPage() == -1){
                    return array( 'data' => $query->get());
                }
                
                if(Input::get('page')){
                    $page = Input::get('page');
                } else {
                    $page = 1;
                }
                Paginator::setCurrentPage($page);
                
                if(Input::get('limit') > 0){
                    $limit = Input::get('limit');
                } else {
                    $limit = $this->model->getPerPage();
                }
                
                $result = $query->paginate($limit);
                return $this->model->paginateToArray($result);
            }catch(Exception $e){
                echo Response::exception($e);
                return $query;
            }
	}
        
        /**
	 * Store a newly created resource in storage.
	 * POST /admin/master/base
	 * 
	 * @return Response
	 */
	public function store()
	{
            
        }
        
        /**
	 * Update the specified resource in storage.
	 * PUT /admin/master/base/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
            
        }
        
        /**
	 * Remove the specified resource from storage.
         * Soft Delete. Mark delete_at and deleted_by column
	 * DELETE /admin/master/base/{id}
	 *
	 * @param  int  $param parameter Id can be id collective (1,2,3) or single id (1)
	 * @return Response
	 */
	public function destroy($param)
	{
            
        }
}