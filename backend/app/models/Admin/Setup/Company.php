<?php
namespace Admin\Setup;

use BasicModels;

class Company extends BasicModels {
    /**
    * The database table used by the model.
    *
    * @var string 
    */ 
   protected $table = 'company';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
//   protected $fillable = array('compName','compNick','compCity');
   
   protected $fillable = array('compName','compNick','compAddress','compPostCode','compCity','compTelp','compTelp2','compFax1'
                               ,'compFax2','compEmail','compLogo','compKlinikId');
   /**
    * The primary key for the model.
    *
    * @var string
    */
   protected $primaryKey = 'compId';

   /**
    * The name of the company id column.
    *
    * @var string
    */
   //const COMPANY_ID = 'compId';
   
   /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = true;
   
   public $companystamps = false;
   /**
    * The name of the "created at" column.
    *
    * @var string
    */
   const CREATED_AT = 'compCreatedTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'compCreatedUserId';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'compUpdatedTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'compUpdatedUserId';

   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'compDeletedTime';

   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'compDeletedUserId';


}