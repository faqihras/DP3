<?php
namespace Admin\Kinerja;

use BasicModels;

class Kinerjaheader extends BasicModels {

  protected $table = 'trStokHeader';

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
    protected $fillable = array('stokhNota','stokhNoTrans','stokhGudang','stokhNoFaktur','stokhNoKontrak',
    'stokhNoPemeriksaan','stokhNoKwitansi','stokhNoPenerimaanGudang','stokhJenisPenerimaan',
    'stokhTglFaktur','stokhSuplier','stokhJthTempo','stokhNoPo','stokhTglTerima','stokhSumberDana','stokhPpn',
    'stokhDiskonFaktur','stokhPpnNilai','stokhTotal','stokhSkpd');

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
    protected $primaryKey = 'stokhId';

    public $timestamps = true;
   public $companystamps = false;

   /**
    * The name of the "created at" column.
    *
    * @var string
    */
   const CREATED_AT = 'stokhCreateTime';

   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'stokhCreateUser';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'stokhUpdateTime';

   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'stokhUpdateUser';

   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'stokhDeleteTime';

   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'stokhDeleteUser';

}
