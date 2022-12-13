<?php
namespace Admin\Tool;

use BasicModels;

class Mappreal extends BasicModels {

  protected $table = 'mappreal';

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
    protected $fillable = array('mappSkpdKd','mappKegKd','mappRekLra','mappRekLo','mapNilaiAng','mapNilaiTrans');
        
  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
    protected $primaryKey = 'mappId';

    public $timestamps = true;
   public $companystamps = false;
   
   /**
    * The name of the "created at" column.
    *
    * @var string
    */
   const CREATED_AT = 'mappCreateTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'mappCreateUser';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'mappUpdateTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'mappUpdateUser';
   
   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'mappDeleteTime';
   
   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'mappDeleteUser';

}