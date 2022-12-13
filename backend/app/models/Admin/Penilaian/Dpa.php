<?php
namespace Admin\Penilaian;

use BasicModels;

class Dpa extends BasicModels {

  protected $table = 'trdpa';

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
        protected $fillable = array(
            'dpaNip','dpaNama','dpac1','dpac2','dpac3','dpac4','dpac5','dpac6','dpac7','dpac8','dpac9','dpac10','dpac11','dpac12','dpac13','dpac14','dpac15','dpac16',
    );
        
  /**
   * The attributes excluded from the model's JSON form.
   *
   * 
   * @var array
   */
    protected $primaryKey = 'dpaId';

    public $timestamps = true;
   public $companystamps = false;
   
   /**
    * The name of the "created at" column.
    *
    * @var string
    */
   const CREATED_AT = 'dpaCreateTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'dpaCreateUser';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'dpaUpdateTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'dpaUpdateUser';
   
   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'dpaDeleteTime';
   
   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'dpaDeleteUser';

}