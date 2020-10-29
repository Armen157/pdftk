<?php

namespace App\Http\Controllers;
use App\Models\files;
use Illuminate\Http\Request;

class ApiPDF extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllPdfs(){

        // get all pdfs
        $pdfs = files::Select('file_name')->get();

        // if pdfs is empty
        if($pdfs->isEmpty()){
            return response()->json(['error'=>true,'message'=>'Not found'],404);
        }

        return response()->json($pdfs,200);
    }
}
