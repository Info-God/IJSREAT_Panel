<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Editorial_board;
use Illuminate\Http\Request;

class EditorialController extends Controller
{
    public function editorialFetch(Request $request)
    {
        $header = $request->header("Authorization");
        if (empty($header)) {
            $message = "Unauthenticated";
            return response()->json(["error" => $message], 404);
        } elseif ($header == "e1b3d61a14729026509aee1c291c8965f928ab08c5cc2562b46bc6962834983b") {
            $domainName = 'https://ijsreat.com/editor';
            // $domainName = 'https://ijsreat.com/editor';

            $index = Editorial_board::select('*')
                ->get()
                ->map(function ($item) use ($domainName) {
                    // Add the domain name to the indexing_image_url
                    $item->member_image_url = $domainName . '/' . ltrim($item->member_image_url, '/');
                    return $item;
                });;
            return response()->json(["membersList" => $index], 200);
        } else {
            $message = "Unauthenticated";
            return response()->json(["error" => $message], 404);
        }
    }
}
