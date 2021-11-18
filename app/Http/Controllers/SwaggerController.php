<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SwaggerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("swagger.index");
    }

    public function arquivoDocumentacao()
    {
        $arquivo = json_decode(file_get_contents(storage_path("app/public/swagger/swagger.json")));
        return response()->json($arquivo);
    }
}
