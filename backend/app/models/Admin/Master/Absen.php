<?php

namespace Admin\Master;

use BasicModels;

class Absen extends BasicModels {
    /**
    * The database table used by the model.
    *
    * @var string
    */ 
   protected $table = 'absen';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

   protected $fillable = array('abUserId','abJamMasuk','abLoc','abJamPulang','abWaktuAbsen','abLat','abLng','abPhoto','abJenis','abKet');
   /**
    * The primary key for the model.
    *
    * @var string
    */
   protected $primaryKey = 'abId';

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
   const CREATED_AT = 'abCreateTime';

   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'abCreateUser';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'abUpdateTime';

   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'abUpdateUser';

   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'abDeleteTime';

   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'abDeleteUser';


}
