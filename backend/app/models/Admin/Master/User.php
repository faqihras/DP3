<?php
namespace Admin\Master;

use BasicModels;

class User extends BasicModels {

  protected $table = 'admin_users';

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
    protected $fillable = array('ausrUsername','ausrName','ausrRolhId', 'ausrUnit');
        
  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
    protected $primaryKey = 'ausrId';

    public $timestamps = true;
   public $companystamps = false;
   
   /**
    * The name of the "created at" column.
    *
    * @var string
    */
   const CREATED_AT = 'ausrCreated';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = '';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = '';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = '';
   
   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = '';
   
   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = '';

}