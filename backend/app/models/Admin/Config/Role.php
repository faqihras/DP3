<?php
namespace Admin\Config;

use BasicModels;

class Role extends BasicModels {
    /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'role';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = array('roleName','roleNonActive','roleStatus');
   
   /**
    * The primary key for the model.
    *
    * @var string
    */
   protected $primaryKey = 'roleId';
   
   /**
    * Indicates if the model should be has company stamps.
    *
    * @var bool
    */
     public $companystamps = false;
   
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
   const CREATED_AT = 'roleCreatedTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'roleCreatedUserId';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'roleUpdatedTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'roleUpdatedUserId';
   
   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'roleDeletedTime';

   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'roleDeletedUserId';
}