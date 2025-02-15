<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Indexing;
use Illuminate\Http\Request;

class IndexAPIController extends Controller
{
    public function indexFetch(Request $request)
    {
        $header = $request->header("Authorization");
        if (empty($header)) {
            $message = "Unauthenticated";
            return response()->json(["error" => $message], 404);
        } elseif ($header == "e1b3d61a14729026509aee1c291c8965f928ab08c5cc2562b46bc6962834983b") {
            $domainName = 'https://ijsreat.com/indexer';



            // Fetch the domain name from the app configuration

            $index = Indexing::select(
                'indexing_id',
                'indexing_name',
                'indexing_url',
                'is_active',
                'is_deleted',
                'indexing_image_url',
                'created_at as createdtime',
                'updated_at as modifiedtime'
            )
                ->get()
                ->map(function ($item) use ($domainName) {
                    // Add the domain name to the indexing_image_url
                    $item->indexing_image_url = $domainName . '/' . ltrim($item->indexing_image_url, '/');
                    return $item;
                });

            return response()->json(["indexingList" => $index], 200);
        } else {
            $message = "Unauthenticated";
            return response()->json(["error" => $message], 404);
        }
    }
}
