<?php
namespace Admin;
use DB;
use Lang;

class AppointmentController extends \BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new \User\Appointment();
         $this->menuLink = 'appointment';
//         $this->validator = new BankValidator();
     }

    public function index() {
     try {
            $query = DB::table($this->model->getTable())
                    ->select('apscId','apscDateTime','apscGuestName','apscGuestEmail','apscGuestPhone','apscRequestDate','apscMeetingMode','apscGuestMessage',
                    DB::raw('(CASE WHEN apscCustomerMode = 1 THEN "'.Lang::get('general.yes').'" ELSE "'.Lang::get('general.no').'" END) AS apscCustomerModeDescription')
                    );

            return $this->getDataGrid($query);                
        }catch(Exception $e){
            return Response::exception($e);
        } 
    }
}