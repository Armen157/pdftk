<?php

namespace App\Http\Controllers;

use App\Models\files;
use App\Models\form_fields;
use Illuminate\Http\Request;
use mikehaertl\pdftk\Pdf;

class EditFile extends Controller
{

    /**
     * @param $file_id
     * @param $nested_array
     * @return string
     */
    public static function EditPdf($file_id, $nested_array){

        $file_id = files::select('file_name')->where('file_id', $file_id)->get();
        $file_name = $file_id[0]->file_name;


        $full_path = public_path("uploads/").$file_name;
        $new_file = time().'.'.'pdf';
        $save_as = public_path("generating/").$new_file;
        $pdf = new Pdf($full_path ,
            [
                'command' => env('PDFTK_EXECUTE'),
                'useExec' => true,
            ]
        );

        $pdf->fillForm($nested_array)
        ->needAppearances()
        ->saveAs($save_as);

        return $new_file;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function EditFieldValues(Request $request){

        $nested_array = array();
        $file_id = $request->input('file_id');

        $get_fields_names = form_fields::select('field_name')->where('file_id', $file_id)->get();

        foreach ($get_fields_names AS $key=>$field_name){
            $field_name = $field_name->field_name;

            $nested_array[$field_name] = $request->input($field_name);

            form_fields::where('file_id',$file_id)->where('field_name',$field_name)->update([
                'field_value' => $request->input($field_name)
            ]);
        }

        //Edit PDF Fields
        $new_file_name = self::EditPdf($file_id,$nested_array);

        return view('fileDownload',['file_name'=> $new_file_name]);
    }
}
