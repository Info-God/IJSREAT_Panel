<?php

namespace App\Http\Controllers;

use App\Models\Indexing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has("indexing_name")) {
            $indexing = Indexing::where('indexing_name', 'like', '%' . $request->indexing_name . '%')->orderBy('indexing_id', 'desc')->paginate(5);
            return view("index.indexing", compact("indexing"));
        } else {
            $indexing = Indexing::orderBy('indexing_id', 'desc')->paginate(5);
            return view("index.indexing", compact("indexing"));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view("index.indexing-create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'indexing_name' => 'required',
            'indexing_image_url' => 'required|file|mimes:png,jpg,jpeg,gif|max:20480',
            'indexing_url' => 'required'
        ]);

        $image = null;
        if ($request->hasFile('indexing_image_url')) {
            $image = $request->file('indexing_image_url')->store('indexing', 'public');
        }
        $record = Indexing::create([
            "indexing_name" => $request->indexing_name,
            "indexing_url" => $request->indexing_url,
            "indexing_image_url" => $image

        ]);

        return redirect()->route("index-home")->withSuccess("Indexing created success");
    }

    public function destroy(string $id)
    {

        $index = Indexing::find($id);

        $image = $index->indexing_image_url;


        if ($image && Storage::disk('public')->exists($image)) {
            // Delete the old image from the storage
            Storage::disk('public')->delete($image);
        }

        $index->delete();

        return redirect()->route('index-home');
    }

    public function toggleStatus(Request $request, $indexing_id)
    {
        // Find the indexing record by ID
        $indexing = Indexing::where("indexing_id", $indexing_id)->first();

        // Update the 'is_active' status
        $indexing->is_active = $request->has('is_active') ? 1 : 0; // Check if checkbox is checked
        $indexing->save();

        // Redirect back to the index page
        return redirect()->route('index-home')->withSuccess('Indexing status updated!');
    }
}
