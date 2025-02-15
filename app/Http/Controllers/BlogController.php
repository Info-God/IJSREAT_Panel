<?php

namespace App\Http\Controllers;

use App\Models\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has("description")) {
            $blogs = blog::where('description', 'like', '%' . $request->description . '%')->orderBy('id', 'desc')->paginate(10);
            return view('blog.blog', compact('blogs'));
        } else {
            $blogs = blog::orderBy('id', 'desc')->paginate(10);
            return view('blog.blog', compact('blogs'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.blog_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'image' => 'required|file|mimes:png,jpg,jpeg,gif|max:20480',
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('blog', 'public');
        }

        $blog = blog::create([
            "description" => $request->description,
            "image" => $image

        ]);

        return redirect()->route("blog-home")->withSuccess("Blog Created Successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = blog::find($id);
        return view('blog.blog_edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $record = blog::find($id);

        $image = $record->image;  // Keep the existing image by default

        // If a new file is uploaded, store the file and update the image path
        if ($request->hasFile('image')) {
            // Store the new image
            if ($image && Storage::disk('public')->exists($image)) {
                // Delete the old image from the storage
                Storage::disk('public')->delete($image);
            }
            $image = $request->file('image')->store('blog', 'public');
        }


        $record->update([
            "description" => $request->description,
            "image" => $image

        ]);
        return redirect()->route("blog-home")->withSuccess("Blog Successfully Updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $edit = blog::find($id);

        $image = $edit->image;

        if ($image && Storage::disk('public')->exists($image)) {
            // Delete the old image from the storage
            Storage::disk('public')->delete($image);
        }

        $edit->delete();
        return redirect()->route('blog-home')->withSuccess("Successfully deleted!");
    }
}
