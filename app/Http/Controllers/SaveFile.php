<?php

namespace App\Http\Controllers;

use App\Models\file_types;
use App\Models\files;
use App\Models\form_fields;
use Illuminate\Http\Request;
use mikehaertl\pdftk\Pdf;

class SaveFile extends Controller
{

    public $file_name;

    /**
     * SaveFile constructor.
     * @param $file_name
     */
    public function __construct($file_name){
        $this->file_name = $file_name;
    }

    /**
     * @return mixed
     */
    public function saveFileProperties(){

       return files::create([
            'file_name' => $this->file_name
        ]);
    }


    /**
     * @param $fields
     * @param $file_id
     * @return bool
     */
    public function saveFileFieldProperties($fields, $file_id){

        foreach ($fields AS $key=> $field){

            // FieldProperties
            $field_name = $field['FieldName'];
            $field_type = $field['FieldType'];

             form_fields::create([
                'file_id' => $file_id,
                'field_name' => $field_name,
                'field_type' => $field_type,
            ]);

        }

        return true;
    }
}
