<?php
namespace Admin\Config;

use BasicModels;

class Company extends BasicModels {
    /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'company';
   
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = array('compNick','compName','compAddress','compPostCode','compTelp',
    'compCity','compTelp2','compFax','compFax2','compEmail','compLogo','compKlinikId','compBankBranch','compBankAccNo','compBankAccName','compAmountAnnualFee','compNonActiveFlag','compStatusAnggaran');
   
   /**
    * The primary key for the model.
    *
    * @var string
    */
   protected $primaryKey = 'compId';
   
   /**
    * The name of the company id column.
    *
    * @var string
    */
   public $companystamps = false;
   
   /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = true;
   
   /**
    * The name of the "created at" column.
    *
    * @var string
    */
   const CREATED_AT = 'compCreatedTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'compCreatedUserId';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'compUpdatedTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'compUpdatedUserId';
   
   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'compDeletedTime';
   
   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'compDeletedUserId';
}