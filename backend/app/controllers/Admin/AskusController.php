<?php
namespace Admin;

use BasicController;
use \Input;
use Mail;
use Session;
use Permission;

class AskusController extends BasicController {
    /**
     * Set Model's Repository
     */
    public function __construct(){
        $this->model = new \User\Askus();
        $this->menuLink = 'support_askus';
    }

    public function store() {
        
        parent::store();
 
        //$this->model = new \User\Appointment();
        //parent::store();

        $name=Input::get('askName');
 		
    	try {
    		
    		Mail::send('email', array('name'=>Input::get('askName'),'email'=>Input::get('asEmail'),'phone'=>Input::get('asphone'),'question'=>Input::get('asQuestion')), function($message){
        		$message->to('try.email55@gmail.com', Input::get('asQuestion').' '.Input::get('asQuestion'))->subject('Ask Us Support!');
    		});

             $result['status'] = array(
                'error'     => '0',
                'errorCode' => '0',
                'messages'  => 'Messages Send',
            );

            return $result;
		
		} catch(Exception $e) {
    		echo $e->getMessage();
		}

    }
    public function askLang() {
		
        $compId = Session::get('companyIdUser');

        $datas = \Admin\Config\Company::select()->where('compId',$compId)->get();
        
        foreach ($datas as $data) {
            # code...
            $compName = $data->compName;
            $address= $data->compAddress;
            $city   = $data->compCity;
            $postal = $data->compPostCode;
            $phone  = $data->compTelp;
            $fax    = $data->compFax;
        }
        
      return 
        array (
        "bigTitle1"=>"Ask Us",
        "bigTitle2"=>"Hot Line",
        "column"=>array(
            array(
                //"id"=>"uId",
                "id"=>"asksId",
                "name"=>"ID",
                "width"=>"50"
            ),
            array(
                "id"=>"asksName",
                "name"=>"Name",
                "minVal"=>"",
                "maxVal"=>"",
                "minLength"=>"2",
                "maxLength"=>"50",
                "mandatory"=>"1"
            ),
            array(
                "id"=>"asksEmail",
                "name"=>"Email Address",
                "minVal"=>"",
                "maxVal"=>"",
                "minLength"=>"2",
                "maxLength"=>"50",
                "mandatory"=>"1"
            ),
            array(
                "id"=>"asksPhone",
                "name"=>"Phone",
                "minVal"=>"",
                "maxVal"=>"",
                "minLength"=>"2",
                "maxLength"=>"14",
                "mandatory"=>"1"
            ),
            array(
                "id"=>"asksQuestion",
                "name"=>"Question",
                "minVal"=>"",
                "maxVal"=>"",
                "minLength"=>"2",
                "maxLength"=>"200",
                "mandatory"=>"1"
            )
        ),
        "company"=>array(
            "name"=> $compName,
            "address"=>$address,
            "city"=>$city,
            "postal"=>$postal,
            "phone"=>$phone,
            "fax"=>$fax,
    ),
        "status"=>array(
            "type"=>0,
            "error"=>0,
            "errorCode"=>0,
            "message"=>"no error"
        )
    );
    
    }
}
