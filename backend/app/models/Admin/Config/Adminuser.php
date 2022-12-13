<?php

/*
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Useradmin extends Eloquent implements UserInterface, RemindableInterface {

   use UserTrait, RemindableTrait;

   protected $table = 'admin_users';

    protected $fillable = array('ausrUsername','ausrPassword');
        
    public $companystamps = false;

   protected $hidden = array('ausrPassword');

   protected $attributes = array();
}
*/



class Useradmin extends BasicModels {

   /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'admin_users';

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
    protected $fillable = array('ausrUsername','ausrPassword','ausrName','ausrRolhId','ausrUnit','ausrSkpd');
        
   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
    protected $primaryKey = 'ausrId';
   public $companystamps = false;
   protected $attributes = array();
}
