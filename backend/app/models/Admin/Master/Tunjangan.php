<?php
namespace Admin\Master;

use BasicModels;

class Tunjangan extends BasicModels {

  protected $table = 'ms_tunjangan';

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
    protected $fillable = array('tunjId','tunjNip','tunjGaPok','tunjPrsnGaPok','tunjSI','tunjAnak','tunjPerbaikan','tunjEselon','tunjFungsional','tunjGuru','tunjLangka','tunjMahalDaerah','tunjTerpencil','tunjKhusus','tunjPajak','tunjAskes','tunjBeras','tunjUmum','tunjPembulatan','tunjHasilKotor','tunjIuranJkk','tunjIuranJkm','tunjPiwp2','tunjPiwp8');
        
  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
    protected $primaryKey = 'tunjId';

    public $timestamps = true;
   public $companystamps = false;
   
   /**
    * The name of the "created at" column.
    *
    * @var string
    */
   const CREATED_AT = 'tunjCreateTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'tunjCreateUser';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'tunjUpdateTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'tunjUpdateUser';
   
   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'tunjDeleteTime';
   
   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'tunjDeleteUser';

}