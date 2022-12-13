<?php
namespace Admin\Penilaian;

use BasicModels;

class Dpsk extends BasicModels {

  protected $table = 'trdpsk';

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
        protected $fillable = array(
            'dpskNip','dpskNama','dpskJan','dpskc1','dpskc2','dpskc3','dpskc4','dpskc5','dpskc6','dpskc7','dpskc8','dpskc9','dpskc10','dpskc11','dpskc12'
    );
        
  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
    protected $primaryKey = 'dpskId';

    public $timestamps = true;
   public $companystamps = false;
   
   /**
    * The name of the "created at" column.
    *
    * @var string
    */
   const CREATED_AT = 'dpskCreateTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'dpskCreateUser';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'dpskUpdateTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'dpskUpdateUser';
   
   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'dpskDeleteTime';
   
   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'dpskDeleteUser';

}