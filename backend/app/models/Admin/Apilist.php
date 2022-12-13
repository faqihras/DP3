<?php
namespace Admin;

use BasicModels;

class Apilist extends BasicModels {
    /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'apilist';

   /**
    * The primary key for the model.
    *
    * @var string
    */
   protected $fillable = array('apiFormCode','apiLangGrid','apiLangForm','apiData');

   protected $primaryKey = 'apiId';

   /**
    * The name of the company id column.
    *
    * @var string
    */
   public $companystamps = false;
   
   /**
    * The number of models to return for pagination.
    *
    * @var int
    */
//   protected $perPage = -1;
   
   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
//   const DELETED_BY = 'menuDeletedUserId';
}