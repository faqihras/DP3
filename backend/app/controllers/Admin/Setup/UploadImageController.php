<?php
namespace Admin\Setup;

use BasicController;
use DB;
use Lang;
use Input;
use Image;


class UploadImageController extends BasicController {
    /**
     * Set Model's Repository
     */

     function store(){

        if (Input::hasFile('compLogo')) { 
            $fname=Input::file('compLogo')->getClientOriginalName();
            $path=public_path().'/upload/';
            $ext =Input::file('compLogo')->getClientOriginalExtension();
            Input::file('compLogo')->move($path,$fname);


            $img = Image::make($path.$fname);
            $img->fit(200);
            $img->save($path.'thumb/'.$fname);


            $id=Input::get('compId');
            DB::table('company')
                ->where('compId','=', $id)
                ->update(array('compLogo' => $fname));            
        }

        if (Input::hasFile('trRadFoto')) { 
            $fname=Input::file('trRadFoto')->getClientOriginalName();
            $path=public_path().'/upload/';
            $ext =Input::file('trRadFoto')->getClientOriginalExtension();
            Input::file('trRadFoto')->move($path,$fname);

            $img = Image::make($path.$fname);
            $img->fit(200);
            $img->save($path.'thumb/'.$fname);

            $id=Input::get('trRadioId');
            DB::table('trRawatRadiology')
                ->where('trRadioId','=', $id)
                ->update(array('trRadFoto' => $fname));            
        }

        if (Input::hasFile('trlabFoto')) { 
            $fname=Input::file('trlabFoto')->getClientOriginalName();
            $path=public_path().'/upload/';
            $ext =Input::file('trlabFoto')->getClientOriginalExtension();
            Input::file('trlabFoto')->move($path,$fname);

            $img = Image::make($path.$fname);
            $img->fit(200);
            $img->save($path.'thumb/'.$fname);

            $id=Input::get('trlabId');
            DB::table('trRawatLab')
                ->where('trlabId','=', $id)
                ->update(array('trlabFoto' => $fname));            
        }

        return array('status'=>'no error');

     }

}