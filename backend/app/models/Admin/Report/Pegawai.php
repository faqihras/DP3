<?php
namespace Admin\Report;

use BasicModels;

class Pegawai extends BasicModels {

  protected $table = 'ms_pegawai';

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
    protected $fillable = array('pegId','pegNoUrut','pegNip','pegNama','pegTempatLahir','pegTglLahir','pegPendidikan','pegPangkat','pegTmtPangkat','pegJabatan','pegTmtJabatan','pegAngkaKredit','pegMasaKerjaThn','pegMasaKerjaBln','pegGaji','pegUnit','pegTmtUnit','pegInstansi','pegEselon','pegTmtEselon','pegJk','pegAlamat','pegTlp','pegAgama','pegKawin','pegPensiun','pegDiklat','pegTmtDiklat','pegSkCpns','pegTmtCpns','pegSkPns','pegTmtPns','pegKarpeg','pegSi','pegSiTempatLahir','pegSiTglLahir','pegSkBerkala','pegTmtBerkala');
        
  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
    protected $primaryKey = 'pegId';

    public $timestamps = true;
   public $companystamps = false;
   
   /**
    * The name of the "created at" column.
    *
    * @var string
    */
   const CREATED_AT = 'pegCreateTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'pegCreateUser';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'pegUpdateTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'pegUpdateUser';
   
   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'pegDeleteTime';
   
   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'pegDeleteUser';

}