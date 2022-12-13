<?php
namespace Admin\Penilaian;

use BasicModels;

class Dpak extends BasicModels {

  protected $table = 'trdpak';

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
        protected $fillable = array(
            'docC','dpakNip','dpakNama','dpakJan','dpakFeb','dpakMar','dpakApr','dpakMei','dpakJun','dpakJul','dpakAgs','dpakSep','dpakOkt','dpakNov','dpakDes','dpakJan1','dpakJan2','dpakJan3','dpakJan4','dpakJan5','dpakFeb1','dpakFeb2','dpakFeb3','dpakFeb4','dpakFeb5','dpakMar1','dpakApr2','dpakMei3','dpakMei4','dpakMei5','dpakMei1','dpakMei2','dpakMei3','dpakMei4','dpakMei5','dpakMei1','dpakMei2','dpakMei3','dpakMei4','dpakMei5','dpakJun1','dpakJun2','dpakJun3','dpakJun4','dpakJun5','dpakJul1','dpakJul2','dpakJul3','dpakJul4','dpakJul5','dpakAgs1','dpakAgs2','dpakAgs3','dpakAgs4','dpakAgs5','dpakSep1','dpakSep2','dpakSep3','dpakSep4','dpakSep5','dpakOkt1','dpakOkt2','dpakOkt3','dpakOkt4','dpakOkt5','dpakNov1','dpakNov2','dpakNov3','dpakNov4','dpakNov5','dpakDes1','dpakDes2','dpakDes3','dpakDes4','dpakDes5','categoriId',
    );
        
  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
    protected $primaryKey = 'dpakId';

    public $timestamps = true;
   public $companystamps = false;
   
   /**
    * The name of the "created at" column.
    *
    * @var string
    */
   const CREATED_AT = 'dpakCreateTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'dpakCreateUser';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'dpakUpdateTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'dpakUpdateUser';
   
   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'dpakDeleteTime';
   
   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'dpakDeleteUser';

}