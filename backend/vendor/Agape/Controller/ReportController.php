<?php
/**
 * Report base controller 
 * 
 */
namespace Agape\Controllers;

use App;
use View;
use Lang;
use Session;
use \Agape\Auth\Permission as Permit;

class ReportController extends \Agape\ReportController {
    /**
     * Report title
     * @var string
     */    
    protected $title = '';

    /**
     * Generate pdf file
     * @param string $html
     * @return pdf file
     */
    protected function pdf($html, $filename) {
        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadHTML($html)
                ->setPaper('A4')
                ->setOption('print-media-type',true)
                ->setOption('margin-bottom','15')
                ->setOption('margin-left','10')
                ->setOption('margin-top','15')
                ->setOption('header-font-size','14')
                ->setOption('header-spacing', '3')
                ->setOption('header-left', Session::get('companyName'))
                ->setOption('header-right', $this->title)
                ->setOption('footer-line',true)
                ->setOption('footer-font-size','8')
                ->setOption('footer-left',Lang::get('reports.printby').' '. 
                        Session::get('userName').' '.
                        $this->dateFormat(date('Y-m-d')).' [time]')
                ->setOption('footer-right',Lang::get('reports.page'). 
                        ' [page] '.Lang::get('reports.of').' [toPage]');
        
        return $pdf->stream($filename);
    }
   
}