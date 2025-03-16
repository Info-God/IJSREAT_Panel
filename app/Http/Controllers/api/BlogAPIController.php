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
            return response()->json(["error" => "Unauthenticated"], 404);
        }
    
        if ($header == "e1b3d61a14729026509aee1c291c8965f928ab08c5cc2562b46bc6962834983b") {
            $domainName = 'https://ijsreat.com/blogImage';
    
            $validate = Validator::make($request->all(), [
                'url_title' => 'required|exists:blogs,url_title',
            ]);
    
            if ($validate->fails()) {
                return response()->json(['errors' => $validate->errors()], 404);
            }
    
           
            $blog = Blog::where('url_title', $request->url_title)->first();
    
            
            if (!$blog) {
                return response()->json(["error" => "Blog not found"], 404);
            }
    
            
            $blog->image = $domainName . '/' . ltrim($blog->image, '/');
    
            return response()->json([
                "blogDetails" => [
                    "id" => $blog->id,
                    "title" => $blog->title,
                    "url_title" => $blog->url_title,
                    "category" => $blog->category,
                    "meta_title" => $blog->meta_title,
                    "meta_description" => $blog->meta_description,
                    "tags" => $blog->tags,
                    "image" => $blog->image,
                    "created_at" => $blog->created_at,
                    "updated_at" => $blog->updated_at,
                ]
            ], 200);
        }
    
        return response()->json(["error" => "Unauthenticated"], 404);
    }
    
    
}
