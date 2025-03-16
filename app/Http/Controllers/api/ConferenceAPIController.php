<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Conference;

use Illuminate\Http\Request;

class ConferenceAPIController extends Controller
{
    public function conferenceFetch(Request $request)
    {
        $header = $request->header("Authorization");
    
        if (empty($header)) {
            return response()->json(["error" => "Unauthenticated"], 404);
        } elseif ($header == "e1b3d61a14729026509aee1c291c8965f928ab08c5cc2562b46bc6962834983b") {
            $id = $request->id;
    
            // Apply a where condition to filter by category_id
            $rec = Conference::where('category_id', $id)->get();
    
            // If no record is found, return an empty array
            if ($rec->isEmpty()) {
                return response()->json(["error" => "No conference found"], 404);
            }
    
            $domainName = 'https://ijsreat.com/conferencePDF/';
    
            // Append the domain to the `pdf_url` field dynamically
            $rec = $rec->map(function ($conference) use ($domainName) {
                // Ensure `pdf_url` is not null before appending
                if (!empty($conference->pdf_url)) {
                    $conference->pdf_url = $domainName . $conference->pdf_url;
                }
                return $conference;
            });
    
            return response()->json(["ConferenceList" => $rec], 200);
        } else {
            return response()->json(["error" => "Unauthenticated"], 404);
        }
    }
}

