<?php
namespace Admin\Config;

use BasicController;
use DB;
use Lang;

class CompanyController extends BasicController
{
    /**
     * Set Model's Repository
     */
    public function __construct()
    {
        $this->model = new Company();
    }

    /**
     * Display a listing of the resource.
     * The default list is undeleted list
     * GET api url
     *
     * @return Response
     */
    public function index()
    {
        try {
            $query = DB::table($this->model->getTable())
                ->select(
                    '*',
                    DB::raw('(CASE WHEN compNonActiveFlag = 1 THEN "' . Lang::get('general.yes') . '" ELSE "' . Lang::get('general.no') . '" END) AS compNonActiveFlag'),
                    DB::raw('if(compLogo<>"",concat("<a class=\'fancybox\' rel=\'gallery1\' title=\'\' href=\'backend/public/upload/thumb/",compLogo,"\'><img class=\'img-responsive\' src=\'backend/public/upload/thumb/",compLogo,"\' ></a>"),"") as compLogo'),
                    'compKlinikId'
                );

            return $this->getDataGrid($query);
        } catch (Exception $e) {
            return Response::exception($e);
        }
    }
}
