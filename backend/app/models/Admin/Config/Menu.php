<?php
namespace Admin\Config;

use BasicModels;

class Menu extends BasicModels {
    /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'menu';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = array('menuId',
                               'menuScope',
                               'menuName',
                               'apiLangGrid',
                               'apiLangForm',
                               'apiData',
                               'menuLink',
                               'htmlLink',
                               'menuParentId',
                               'menuIcon',
                               'menuOrder');
   
   /**
    * The primary key for the model.
    *
    * @var string
    */
   protected $primaryKey = 'menuId';

   /**
    * The name of the company id column.
    *
    * @var string
    */
    public $timestamps = true;
   public $companystamps = false;
   
   /**
    * The name of the "created at" column.
    *
    * @var string
    */
   const CREATED_AT = 'menuCreatedTime';
   
   /**
    * The name of the "created by" column.
    *
    * @var string
    */
   const CREATED_BY = 'menuCreatedUserId';

   /**
    * The name of the "updated at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'menuUpdatedTime';
   
   /**
    * The name of the "updated by" column.
    *
    * @var string
    */
   const UPDATED_BY = 'menuUpdatedUserId';
   
   /**
    * The name of the "deleted at" column.
    *
    * @var string
    */
   const DELETED_AT = 'menuDeletedTime';

   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'menuDeletedUserId';
}