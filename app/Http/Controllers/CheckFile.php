<?php

namespace App\Http\Controllers;

use mikehaertl\pdftk\Pdf;

class CheckFile extends Controller
{

    /**
     * @param $file_name
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public static function checkExistFields($file_name){

        $full_path = public_path("uploads/").$file_name;

        $pdf = new Pdf($full_path ,
            [
                'command' => env('PDFTK_EXECUTE'),
                'useExec' => true,
            ]
        );

        $fields = (array)$pdf->getDataFields();
        if($fields){
            return $fields;
        }else{
            return back()->withErrors(['msg', 'There are no fields in this file']);
        }

    }
}
