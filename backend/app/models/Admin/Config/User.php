<?php
namespace Admin\Config;

use BasicModels;

class User extends BasicModels {
    /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'user';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = array('userRolhId', 'userName', 'userFullName', 
       'userPassword', 'userPin', 'userFirstLogin', 'userValidityStart', 'userValidityEnd', 
       'userLanguage', 'userFingerPrintId', 'userNonActive');
   
   /**
    * The primary key for the model.
    *
    * @var string
    */
   protected $primaryKey = 'userId';
   
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
   const CREATED_AT = 'userCreatedTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'userCreatedUserId';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'userUpdatedTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'userUpdatedUserId';
   
   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'userDeletedTime';

   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'userDeletedUserId';
}