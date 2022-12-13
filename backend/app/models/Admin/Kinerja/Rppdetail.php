<?php
namespace Admin\Kinerja;

use BasicModels;

class Rppdetail extends BasicModels {

  protected $table = 'trStokOpnameDetail';

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
    protected $fillable = array('stokNoTrans','stokTanggal','stokBrgId','stokBrgKode','stokBrgNama','stokBrgVolume','stokBrgSatuan','stokBrgHarga','stokBrgBatch','stokBrgExp','stokPpnJenis','stokPpnNilai','stokTotal','stokBrgDiskon','stokKeterangan','stokSkpd');
        
  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
    protected $primaryKey = 'stokId';

    public $timestamps = true;
   public $companystamps = false;
   
   /**
    * The name of the "created at" column.
    *
    * @var string
    */
   const CREATED_AT = 'stokCreateTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'stokCreateUser';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'stokUpdateTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'stokUpdateUser';
   
   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'stokDeleteTime';
   
   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'stokDeleteUser';

}