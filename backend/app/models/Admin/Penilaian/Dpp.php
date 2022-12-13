<?php
namespace Admin\Penilaian;

use BasicModels;

class Dpp extends BasicModels {

  protected $table = 'trdpp';

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
        protected $fillable = array(
            'dpaNip','dpaNama','dppJab','dppUnit','dppJan','dppFeb','dppMar','dppApr','dppMei','dppJun','dppJul','dppAgs','dppOkt','dppNov','dppDes',
    );
        
  /**
   * The attributes excluded from the model's JSON form.
   *
   * 
   * @var array
   */
    protected $primaryKey = 'dppId';
    

    public $timestamps = true;
   public $companystamps = false;
   
   /**
    * The name of the "created at" column.
    *
    * @var string
    */
   const CREATED_AT = 'dppCreateTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'dppCreateUser';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'dppUpdateTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'dppUpdateUser';
   
   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'dppDeleteTime';
   
   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'dppDeleteUser';

}