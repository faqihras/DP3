<?php
namespace Admin\Config\Menuapi;

use BasicModels;

class Menu extends BasicModels {
    /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'menu';

   /**
    * The primary key for the model.
    *
    * @var string
    */
   protected $fillable = array('  menuId  ',
                               '  menuScope ',
                              '  menuName  ',
                              '  apiLangGrid ',
                              '  apiLangForm ',
                              '  apiData ',
                              '  menuLink  ',
                              '  htmlLink  ',
                              '  menuParentId  ',
                              '  menuIcon  ',
                              '  menuOrder ');


   protected $primaryKey = 'menuId';

   /**
    * The name of the company id column.
    *
    * @var string
    */
   public $companystamps = false;
   
   /**
    * The number of models to return for pagination.
    *
    * @var int
    */
   //protected $perPage = -1;
   
   /**
    * The name of the "deleted by" column.
    *
    * @var string
    */
   const DELETED_BY = 'menuDeletedUserId';
}