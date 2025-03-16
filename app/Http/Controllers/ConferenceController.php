<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Conference_Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has("title")) {
            $records = Conference::where('title', 'like', '%' . $request->title . '%')->orderBy('id', 'desc')->paginate(10);
            return view('conference.conference', compact('records'));
        }else {
            $records = Conference::orderBy('id', 'desc')->paginate(10);
            return view('conference.conference', compact('records'));
        }
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $records = Conference_Categories::select("id", 'name')->get();
        return view('conference.conference_create', compact('records'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'author' => 'required',
            'title' => 'required',
            'article_type' => 'required',
            'pages' => 'required',
            'pdf_url' => 'required|file|mimes:pdf|max:20480',
            'category_id' => 'required',
        ]);

        $path = null;
        if ($request->hasFile('pdf_url')) {
            // Get the original title and sanitize it for a filename
            $sanitizedTitle = Str::slug($request->title, '_'); // Converts "My Title 2024" → "my_title_2024"
            
            // Get the file extension
            $extension = $request->file('pdf_url')->getClientOriginalExtension();
            
            // Define the custom filename
            $fileName = $sanitizedTitle . '.' . $extension;

            // Store the file with the custom filename
            $path = $request->file('pdf_url')->storeAs('conference', $fileName, 'public');
        }

        $record = Conference::create([
            "author" => $request->author,
            "title" => $request->title,
            "article_type" => $request->article_type,
            "pages" => $request->pages,
            "pdf_url" => $path,
            "category_id" => $request->category_id,
        ]);

        return redirect()->route("conference-home")->withSuccess("Conference Created Successfully!");
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
        $rec = Conference::find($id);
        return view('conference.conference_edit', compact('rec'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $record = Conference::find($id);
    
        if (!$record) {
            return redirect()->route("conference-home")->withErrors("Conference not found!");
        }
    
        // Keep the old PDF path in case no new file is uploaded
        $pdfPath = $record->pdf_url;
    
        if ($request->hasFile('pdf_url')) {
            // Delete the old PDF file if it exists
            if ($pdfPath && Storage::disk('public')->exists($pdfPath)) {
                Storage::disk('public')->delete($pdfPath);
            }
    
            // Generate new filename using the title
            $sanitizedTitle = Str::slug($request->title, '_'); 
            $extension = $request->file('pdf_url')->getClientOriginalExtension();
            $fileName = $sanitizedTitle . '.' . $extension;
    
            // Store the file with the custom filename
            $pdfPath = $request->file('pdf_url')->storeAs('conference', $fileName, 'public');
        }
    
        // Update the record
        $record->update([
            "author" => $request->author,
            "title" => $request->title,
            "article_type" => $request->article_type,
            "pages" => $request->pages,
            "pdf_url" => $pdfPath
        ]);
    
        return redirect()->route("conference-home")->withSuccess("Conference Successfully Updated!");
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $edit = Conference::find($id);
        $image = $edit->pdf_url;

        if ($image && Storage::disk('public')->exists($image)) {
            // Delete the old image from the storage
            Storage::disk('public')->delete($image);
        }
        $edit->delete();
        return redirect()->route('conference-home')->withSuccess("Successfully deleted!");
    }
}
