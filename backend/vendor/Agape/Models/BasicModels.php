<?php
namespace Agape\Models;

use Eloquent;
use Auth;
use Session;

class BasicModels extends Eloquent {    
   /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;
   
   /**
    * Indicates if the model should be has company stamps.
    *
    * @var bool
    */
   public $companystamps = true;
   
   /**
    * Header foreign key. Uses for detail model
    * 
    * @var string
    */
   protected $headerKey = null;
   
   /**
    * Detail foreign key. Uses for detail model.
    * This uses for combination with header key 
    * to defined specific data on detail db table
    * 
    * @var string
    */
   protected $detailKey = null;
   
   /**
    * Custom soft delete query
    * 
    * @var object  
    */
   protected $softDeleteQuery = null;


   /**
    * Activate soft delete 
    *
    * @var bool
    */
//   protected $softDelete = true; 
   protected $softDelete = false; 
   
   /**
    * The name of the company id column.
    *
    * @var string
    */
   const COMPANY_ID = 'CompId';
   
   /**
    * The name of the "created at" column.
    *
    * @var string
    */
   const CREATED_AT = 'CreatedTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'CreatedUserId';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'UpdatedTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'UpdatedUserId';
   
   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'DeletedTime';
   
   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'DeletedUserId';
   
   /**
    * The number of models to return for pagination.
    *
    * @var int
    */
   protected $perPage = 10;
   
   /**
    * Set the value of the "created at" attribute.
    *
    * @param  mixed  $value
    * @return void
    */
   public function setCreatedAt($value)
   {
        // $inserted_by = 0;
        // if (Auth::check())
        // {
        //     $inserted_by = Auth::user()->id;
        // }

   		$inserted_by=Session::get('userNameAdmin');
        $this->{static::CREATED_AT} = $value;
        $this->{static::CREATED_BY} = $inserted_by;
   }

   /**
    * Set the value of the "deleted at" attribute.
    *
    * @param  mixed  $value
    * @return void
    */
   public function setUpdatedAt($value)
   {
        // $updated_by = 0;
        // if (Auth::check())
        // {
        //     $updated_by = Auth::user()->id;
        // }
        
   		$updated_by=Session::get('userNameAdmin');
        $this->{static::UPDATED_AT} = $value;
        $this->{static::UPDATED_BY} = $updated_by;
   }
   
   /**
    * Update the creation and update timestamps.
    *
    * @return void
    */
   protected function updateTimestamps()
   {
        $time = $this->freshTimestamp();

        if ( ! $this->exists && ! $this->isDirty(static::CREATED_AT))
        {
                $this->setCreatedAt($time);
        } else {
             if ( ! $this->isDirty(static::UPDATED_AT))
             {
                     $this->setUpdatedAt($time);
             }
        }
   }
        
   /**
    * Perform the actual delete query on this model instance.
    *
    * @return void
    */
   public function runSoftDelete()
   {
       if($this->softDelete == true){
           $query = $this->softDeleteQuery;
       } else {
            $query = $this->newQuery()
                ->where($this->getKeyName(), $this->getKey())
                ->where(static::DELETED_BY);
       }
       
        // $deleted_by = 0;

        // if (Auth::check())
        // {
        //     $deleted_by = Auth::user()->id;
        // } else {
        //     //return 400;
        // }

   		$deleted_by=Session::get('userNameAdmin');

        $deleteValues = array(
            static::DELETED_AT => $this->fromDateTime($this->freshTimestamp()),
            static::DELETED_BY => $deleted_by
        );

        //$result = $query->update($deleteValues);
        $result = $query->delete();
        if($result > 0){
            return 2;
        } else if($result == 0){
            return 19;
        }
        return 183;
   }
   
   /**
    * Get a paginator for the "select" statement.
    *
    * @param  int    $perPage
    * @param  array  $columns
    * @return \Illuminate\Pagination\Paginator
    */
   public function paginateToArray($paginate,$draw)
   {
       return array(
            'pagination' => array(
                    'page'          => $paginate->getCurrentPage(),
                    'itemPerPage'   => $paginate->getPerPage(),
                    'totalPage'     => $paginate->getLastPage(),
                    'total'         => $paginate->getTotal()
            ),
            'draw'=> $draw,
            'recordsTotal'=> $paginate->getTotal(),
            'recordsFiltered'=> $paginate->getTotal(),            
            'data' => $paginate->getCollection()->toArray()
        );
   }
   
   /**
    * Get delete by column
    *
    * @return string static value of DELETED_AT
    */
   public function getDeletedBy()
   {
       return static::DELETED_BY;
   }
   
   
   /**
    * Get delete by column
    *
    * @return string static value of DELETED_AT
    */
   public function getCompanyField()
   {
       return static::COMPANY_ID;
   }
   
   /**
    * Determine if the model uses companystamps.
    *
    * @return bool
    */
   public function usesCompanyStamps()
   {
           return $this->companystamps;
   }
   
   /**
    * Get the header id key for the model.
    *
    * @return string headerKey 
    */
   public function getHeaderKey()
   {
       return $this->headerKey;
   }
   
   /**
    * Get the header id key for the model.
    *
    * @return string headerKey 
    */
   public function getDetailKey()
   {
       return $this->detailKey;
   }
   
   /**
    * Set softDeleteQuery values 
    * This uses for defining custom soft delete query
    * 
    * @param object $query 
    */
   public function setSoftDeleteQuery($query) {
       $this->softDeleteQuery = $query;
   }
   
   /**
    * Get new query object
    * 
    * @return object $this->newQuery()
    */
   public function getNewQuery()
   {
       return $this->newQuery();
   }
}
