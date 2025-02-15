<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Conference_Categories;
use Illuminate\Http\Request;

class Conference_categoriesAPIController extends Controller
{
    public function category_dropdown()
    {
        $record = Conference_Categories::select("id", 'name')->get();
        return response()->json(["data" => $record], 200);
    }

    public function conferenceCategoriesFetch(Request $request)
    {
        $header = $request->header("Authorization");
        if (empty($header)) {
            $message = "Unauthenticated";
            return response()->json(["error" => $message], 404);
        } elseif ($header == "e1b3d61a14729026509aee1c291c8965f928ab08c5cc2562b46bc6962834983b") {
            $rec = Conference_Categories::all();

            return response()->json(["Conference_CategoriesList" => $rec], 200);
        } else {
            $message = "Unauthenticated";
            return response()->json(["error" => $message], 404);
        }
    }
}