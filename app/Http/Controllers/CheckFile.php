<?php

namespace App\Http\Controllers;


use App\Models\files;
use mikehaertl\pdftk\Pdf;

class CheckFile extends Controller
{

    /**
     * @param $file_name
     * @return \Illuminate\Contracts\View\View
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

           $file_id = self::IfExistsFieldsInFile($file_name,$fields);

            return view('input', ["fields"=>$fields,"file_id"=>$file_id]);
        }else{
            return back()->withErrors(['msg', 'There are no fields in this file']);
        }

    }

    /**
     * @param $file_name
     * @param $fields
     * @return $file_id
     */
    public static function IfExistsFieldsInFile($file_name, $fields){

        $file = new SaveFile($file_name);

        //Save File Properties
        $file->saveFileProperties();

        //find file_id
        $file_id = files::select('file_id')->where('file_name', $file_name)->get();
        $file_id = $file_id[0]->file_id;


        //Save Fields Properties
        $file->saveFileFieldProperties($fields,$file_id);

        return $file_id;

    }
}
