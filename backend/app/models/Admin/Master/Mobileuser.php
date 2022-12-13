<?php

namespace Admin\Master;

use BasicModels;

class Mobileuser extends BasicModels {
    /**
    * The database table used by the model.
    *
    * @var string 
    */ 
   protected $table = 'mobile_user';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   
   protected $fillable = array('userName','userEmail','userPassword','userPhone','userGender','userBirth');
   /**
    * The primary key for the model.
    *
    * @var string
    */
   protected $primaryKey = 'userId';

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
   const CREATED_AT = 'userCreateTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'userCreateUser';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'userUpdateTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'userUpdateUser';

   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'userDeleteTime';

   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'userDeleteUser';


}