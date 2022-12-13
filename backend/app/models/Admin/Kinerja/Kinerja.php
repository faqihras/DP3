<?php
namespace Admin\Kinerja;

use BasicModels;

class Kinerja extends BasicModels {

  protected $table = 'trlapkinerja';

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
    protected $fillable = array('lkSkpTahun','lkAtasan','lkKegiatan','lkTglAwal','lkTglAkhir','lkTargetWaktu','lkAngkaKredit','lkBiaya','lkKeterangan','lkIdPeg','lkStatus');
        
  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
    protected $primaryKey = 'lkId';

    public $timestamps = true;
   public $companystamps = false;
   
   /**
    * The name of the "created at" column.
    *
    * @var string
    */
   const CREATED_AT = 'lkCreateTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'lkCreateUser';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'lkUpdateTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'lkUpdateUser';
   
   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'lkDeleteTime';
   
   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'lkDeleteUser';

}