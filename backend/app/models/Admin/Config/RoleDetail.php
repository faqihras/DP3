<?php
namespace Admin\Config;

use BasicModels;

class RoleDetail extends BasicModels {
    /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'role_menu';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = array('rolmRoleId', 'rolmMenuId');
   
   /**
    * The primary key for the model.
    *
    * @var string
    */
   protected $primaryKey = 'rolmId';
   
   /**
    * The header id key for the model.
    *
    * @var string
    */
 //  protected $headerKey = 'rolmRoleId';
   
    /**
     * foreign key with header Id is the combination of detail data unique
     * 
     * @var string
     */
//    protected $detailKey = 'rolmMenuId';
    
   
   /**
    * Indicates if the model should be has company stamps.
    *
    * @var bool
    */
   public $companystamps = false;
   
   /**
    * The number of models to return for pagination.
    *
    * @var int
    */
   protected $perPage = 10000;
   
   /**
    * The name of the company id column.
    *
    * @var string
    */
   public $timestamps = true;
   
   /**
    * The name of the "created at" column.
    *
    * @var string
    */
   const CREATED_AT = 'rolmCreatedTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'rolmCreatedUserId';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'rolmUpdatedTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'rolmUpdatedUserId';
   
   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   //const DELETED_AT = 'rolmDeletedTime';

   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   //const DELETED_BY = 'rolmDeletedUserId';
}