<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogAPIController extends Controller
{
    public function blogFetch(Request $request)
    {
       
        $header = $request->header("Authorization");
        if (empty($header)) {
            $message = "Unauthenticated";
            return response()->json(["error" => $message], 404);
        } elseif ($header == "e1b3d61a14729026509aee1c291c8965f928ab08c5cc2562b46bc6962834983b") {
            $domainName = 'https://ijsreat.com/blogImage';
            $blog = blog::all()
                ->map(function ($item) use ($domainName) {
                    // Add the domain name to the indexing_image_url
                    $item->image = $domainName . '/' . ltrim($item->image, '/');
                    return $item;
                });


            return response()->json(["blogList" => $blog], 200);
        } else {
            $message = "Unauthenticated";
            return response()->json(["error" => $message], 404);
        }
    }

    public function blogDetails(Request $request)
    {
        $header = $request->header("Authorization");
        if (empty($header)) {
            $message = "Unauthenticated";
            return response()->json(["error" => $message], 404);
        } elseif ($header == "e1b3d61a14729026509aee1c291c8965f928ab08c5cc2562b46bc6962834983b") {
            $domainName = 'https://ijsreat.com/blogImage';
            $validate = Validator::make($request->all(), [
                'id' => 'required',
            ]);

            if ($validate->fails()) {
                return response()->json(['errors' => $validate->errors()], 404);
            }
            $blog = blog::find($request->id);
            if (empty($blog)) {
                $message = "Blog not found";
                return response()->json(["error" => $message], 404);
            } else {
                $blog->image = $domainName . '/' . ltrim($blog->image, '/');
                return response()->json(["blogDetails" => $blog], 200);
            }

        } else {
            $message = "Unauthenticated";
            return response()->json(["error" => $message], 404);
        }
    }
}
