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

class BasicController extends Controller {
        
        /**
         * Repository model object
         * @var type Object Model
         */
        protected $model;
        
        /**
         * Validator object
         * This object of validator class
         * @var type Object Validator
         */
        protected $validator = null;
        
        /**
         * Validation result object. 
         * This contains result after validate input data.
         * @var type Object Validator
         */
        protected $validation = null;
        
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

                $tahun=date("Y");

                if(!Permit::view($this->menuLink)){
                    return Response::message(144); 
                }
                
                if($tahun<2016){
                    $query = DB::table($this->model->getTable());
                    return $this->getDataGrid($query);     
                }

            }catch(Exception $e){
                return Response::exception($e);
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
//            try {
                if(!Permit::store($this->menuLink)){
                    return Response::message(144); 
                }
                
                if (method_exists($this, 'beforeStore'))
                {
                    $this->beforeStore();
                }

                if($this->validator){
                    $isValid = $this->isValidStoreData();

                    // return error if input data is not valid.
                    if(!$isValid){
                        $error = $this->validation->messages()->toArray();
                        $result = Response::message(107, $error);
                        return Response::json($result); 
                    }
                    $input = $this->validation->inputs();
                } else {
                    $input = Input::all();
                }

                if($this->model->usesCompanyStamps()){
                    $input[$this->model->getCompanyField()] = Session::get('companyId');
                }
        
                $query = $this->model->create($input);
                $id = '';
                
                if($query){
                    $id = $query->{$this->model->getKeyName()};
                    
                    if (method_exists($this, 'afterStoreSuccess'))
                    {
                        $this->afterStoreSuccess($id);
                    }
                    
                    $result = Response::message(5);
                    $result['data'] = $this->model->find($id)->toArray();
                    $result['data']['id'] = $id;
                } else {
                    $result = Response::message(107);
                    $result['data'] = null;
                }
                
                return Response::json($result); 
//            }catch(Exception $e){
//                $error = Response::message(107);
//                $error['status']['exception'] = $e;
//                return $error;
//            } 
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
                
                $result = array();
                $id = $this->checkId($id);
                $data = $this->getShowData($id);
                
                // data not found
                if($data == null){
                    $result = Response::message(103);
                    $result['data'] = null;
                } else {
                    $result['data'] = $data;
                } 
                
                $result['permission'] = Permit::all($this->menuLink);
                return Response::json($result);
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
        protected function getShowData($id) {
            $data = $this->model->find($id);
            if($data){
                $data = $data->toArray();
            }
            return $data;
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
//            try {
                
                if(!Permit::update($this->menuLink)){
                    return Response::message(144); 
                }
            
                if (method_exists($this, 'beforeUpdate'))
                {
                    $this->beforeUpdate();
                }
                
                // check existency
                $data = $this->model->find($id);
                if($data == null){
                    $result = Response::message(103);
                    $result['data'] = null;
                    return Response::json($result); 
                }
                
                if($this->validator){
                    // check validation
                    $isValid = $this->isValidStoreData();
                    if(!$isValid){
                        $error = $this->validation->messages()->toArray();
                        $result = Response::message(107, $error);
                        return Response::json($result); 
                    }
                    $input = $this->validation->inputs();
                } else {
                    $input = Input::all();
                }
                
                if($data == null){
                    $result['data'] = null;
                } else {
                    if($this->model->usesCompanyStamps()){
                        $input[$this->model->getCompanyField()] = Session::get('companyId');
                    }
                    
                    $query = $data->update($input);
                    
                    if (method_exists($this, 'afterUpdate'))
                    {
                        $this->afterUpdate($id);
                    }
                    
                    if($query){
                        
                        if (method_exists($this, 'afterUpdateSuccess'))
                        {
                            $this->afterUpdateSuccess($id);
                        }

                        $result = Response::message(3);
                        $result['data'] = $this->model->find($id)->toArray();
                        $result['data']['id'] = $id;
                    } else {
                        $result = Response::message(106);
                        $result['data'] = null;
                    }
                }
                
                return Response::json($result);
//            }catch(Exception $e){
//                $error = Response::message(106);
//                $error['status']['exception'] = $e;
//                return $error;
//            }
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
	    try {
                if(!Permit::delete($this->menuLink)){
                    return Response::message(144); 
                }
                
                
                if (method_exists($this, 'beforeDestroy'))
                {
                    $this->beforeDestroy();
                }


                $id = $this->checkId($param);
                $data = $this->model->where($this->model->getKeyName() , '=', $id);                
                
                // data not found
                if($data == null){
                    $result = Response::message(103);
                } else {
                    $this->model->setAttribute($this->model->getKeyName(), $id);
                    $status = $this->model->runSoftDelete();
                    $result = Response::message($status);
                } 
                
                $result['permission'] = Permit::all($this->menuLink);
                
                return Response::json($result);
            }catch(Exception $e){
                $error = Response::message(138);
                $error['status']['exception'] = $e;
                return $error;
            }
	}
        
        /**
         * Retrive default error message when delete data
         * 
         * @param boolean $isSuccess
         * @return Response
         */
        public function getDestroyMessage($isSuccess = true)
	{
            if($isSuccess){
                $result = Response::message(2);
            } else {
                $result = Response::message(138);
            }
            $result['permission'] = Permit::delete($this->menuLink);
            return Response::json($result); 
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
//            try {
            
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
//            }catch(Exception $e){
//                return Response::exception($e);
//            }
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
                        case 4: 
                            $query = $query->whereNotIn(Input::get('searchCol'), Input::get('searchText'));
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
                $param=Input::all();
                $param['start']=!empty($param['start'])?$param['start']:0;
                $param['draw']=!empty($param['draw'])?$param['draw']:1;

                $start=$param['start']+10;
                $hal  =ceil($start/10);
                $draw =$param['draw'];

                if(Input::get('limit') == -1){
                    return array( 'data' => $query->get());
                }
                
                if($this->model->getPerPage() == -1){
                    return array( 'data' => $query->get());
                }
                
                //if(Input::get('page')){
                //    $page = Input::get('page');
                if($hal){
                    $page = $hal;
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
                return $this->model->paginateToArray($result,$draw);
	}
        
        /**
         * Convert Id into array if it contains ','
         * 
         * @param Obj $id
         * @return Obj
         */
        protected function checkId($id){
            return (strpos($id, ',') !== FALSE)? explode(',', $id):$id;
        }
        
        /**
         * Validate store data
         * 
         * @param Obj $id
         * @return Obj
         */
        protected function isValidStoreData(){
            if(!is_object($this->validator)) {
                return true;
            }
            
            $this->validation = $this->validator->make(Input::all());

            if ($this->validation->fails())
            {
                return false;
            }
            return true;
        }
        
        /**
        * Get request payload values
        * @return array
        */
       public function getRequestPayload() {
           $input = array();
           $json = (array) Input::json();
           if(!empty($json)){
               foreach ($json as $key => $values) {
                   $input = $values;
                   break;
               }
           }
           return $input;
       }

       public function dateName($tgl){
            $a=explode("/",$tgl);
            if($a[0]=='01'){
                $bln="Januari";
            }elseif($a[0]=='02'){
                $bln="Februari";                
            }elseif($a[0]=='03'){
                $bln="Maret";                
            }elseif($a[0]=='04'){
                $bln="April";                
            }elseif($a[0]=='05'){
                $bln="Mei";                
            }elseif($a[0]=='06'){
                $bln="Juni";                
            }elseif($a[0]=='07'){
                $bln="Juli";                
            }elseif($a[0]=='08'){
                $bln="Agustus";                
            }elseif($a[0]=='09'){
                $bln="September";                
            }elseif($a[0]=='10'){
                $bln="Oktober";                
            }elseif($a[0]=='11'){
                $bln="November";                
            }elseif($a[0]=='12'){
                $bln="Desember";                
            }
            return $a[1].' '.$bln.' '.$a[2];
       }


        public function tambahNol($tgl){
            $a=explode('-', $tgl);

            if(strlen($a[1])==1){
                $bln='0'.$a[1];
            }else{
                $bln=$a[1];            
            }

            if(strlen($a[2])==1){
                $tgl='0'.$a[2];
            }else{
                $tgl=$a[2];            
            }

            return $a[0].'-'.$bln.'-'.$tgl;

        }

        public function parse_string($string, $pjcell)
        {   
            $string_parse = explode(" ",trim($string));
            $jumlah_parse = count($string_parse);
            $x=0;
            $str[$x]='';
            for($a=0;$a<=$jumlah_parse-1;$a++)
            {

                if(strlen($string_parse[$a])+strlen($str[$x]) > $pjcell)
                {
                    $x++;
                    $str[$x]='';
                }
                $str[$x] = $str[$x].$string_parse[$a]." ";

            }
            return $str;
        }


     public function tanggalCetak($tgl){
            // $tgl='10/14/2015';
            if(substr($tgl,2,1)=='/'){
                $a=explode('/',$tgl);
            }else{
                $a=explode('-',$tgl);
                $d=$a[2];                
                $m=$a[1];                
                $y=$a[0];
                $a[0]=$m;                
                $a[1]=$d;                
                $a[2]=$y;                
            }

            $nmbulan='';
            if($a[0]=='01' || $a[0]=='1'){
                $nmbulan='Januari';
            }elseif($a[0]=='02' || $a[0]=='2'){
                $nmbulan='Februari';
            }elseif($a[0]=='03' || $a[0]=='3'){
                $nmbulan='Maret';
            }elseif($a[0]=='04' || $a[0]=='4'){
                $nmbulan='April';
            }elseif($a[0]=='05' || $a[0]=='5'){
                $nmbulan='Mei';
            }elseif($a[0]=='06' || $a[0]=='6'){
                $nmbulan='Juni';
            }elseif($a[0]=='07' || $a[0]=='7'){
                $nmbulan='Juli';
            }elseif($a[0]=='08' || $a[0]=='8'){
                $nmbulan='Agustus';
            }elseif($a[0]=='09' || $a[0]=='9'){
                $nmbulan='September';
            }elseif($a[0]=='010'){
                $nmbulan='Oktober';
            }elseif($a[0]=='11'){
                $nmbulan='November';
            }elseif($a[0]=='12'){
                $nmbulan='Desember';
            }

            $res=$a[1].' '.$nmbulan.' '.$a['2'];
            return $res;
     }

     public function angkaUang($uang){
        if($uang<0){
            $res='('.number_format(abs($uang)).')';
        }else{
            $res=number_format($uang);
        }
        return $res;
     }

     public function revdate($tgl){
        $a=explode("-", $tgl);
        return $a[2].'-'.$a[1].'-'.$a[0];
     }
     public function normaldate($tgl){
        $a=explode("/", $tgl);
        return $this->revdate($a[2].'-'.$a[0].'-'.$a[1]);
     }


    public function cek_token($username,$token){

        $q =DB::table('user_api')
           ->select('*')
           ->where('userToken','=',$token)
           ->where('userName','=',$username)
           ->get();
        if(count($q)>0){
            return true;
        }else{
            return false;
        }
     }

}