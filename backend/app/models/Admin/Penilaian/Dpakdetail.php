<?php
namespace Admin\Penilaian;

use BasicModels;

class Dpakdetail extends BasicModels {

  protected $table = 'trdpakdetail';

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
        protected $fillable = array( 
          'dpakdC1,dpakdC2,dpakdC3,dpakdC4,dpakdC5'
            // 'jadwalkbm','kalender','pekanefektif','analisa','distibusi','analisis','ki','kd','mp','kp','indika','nilai','alokasi','sumber','alokasiwaktu','komin','komdas','indikatorpembelajaran','tujuanpel','mapel','metode','kegiatan','sumberbelajar','bahanbelajar','alatbelajar','penilaian','materipembelajaran','presensi','catatan','bentukkbm','butirsoal','pelaksanaanpenilaian','hasilpenilaian','atl',
    );
        
  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
    protected $primaryKey = 'dpakdId';

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