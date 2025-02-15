<?php

namespace App\Http\Controllers;

use App\Models\Conference_Categories;
use Illuminate\Http\Request;

class Conference_CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has("name")) {
            $records = Conference_Categories::where('name', 'like', '%' . $request->name . '%')->orderBy('id', 'desc')->paginate(10);
            return view('conference_categories.conference_categories', compact('records'));
        }else{
            $records = Conference_Categories::orderBy('id', 'desc')->paginate(10);
            return view('conference_categories.conference_categories', compact('records'));
        }
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('conference_categories.conference_categories_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'organised_by' => 'required',
            'conference_date' => 'required',
            'volume' => 'required',
            'year' => 'required',
            'issue' => 'required',
        ]);


        $record = Conference_Categories::create([
            "name" => $request->name,
            "title" => $request->title,
            "organised_by" => $request->organised_by,
            "conference_date" => $request->conference_date,
            "volume" => $request->volume,
            "year" => $request->year,
            "issue" => $request->issue
        ]);

        if($request->has('control')){
            return  redirect()->route("conference-create");
        }

        return redirect()->route("conference_categories-home")->withSuccess("Conference Categories Created Successfully!");
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
        $rec = Conference_Categories::find($id);
        return view('conference_categories.conference_categories_edit', compact('rec'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $record = Conference_Categories::find($id)->update([
            "name" => $request->name,
            "title" => $request->title,
            "organised_by" => $request->organised_by,
            "conference_date" => $request->conference_date,
            "volume" => $request->volume,
            "year" => $request->year,
            "issue" => $request->issue

        ]);
        return redirect()->route("conference_categories-home")->withSuccess("Conference Categories Successfully Updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $edit = Conference_Categories::where("id", $id)->delete();
        return redirect()->route('conference_categories-home')->withSuccess("Successfully deleted!");
    }
}
