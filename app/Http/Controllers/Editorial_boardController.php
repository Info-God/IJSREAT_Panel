<?php

namespace App\Http\Controllers;

use App\Models\Editorial_board as ModelsEditorial_board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Editorial_boardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has("member_name")) {
            $editorial = ModelsEditorial_board::where('member_name', 'like', '%' . $request->member_name . '%')->orderBy('member_id', 'desc')->paginate(10);
            return view('editorial_board.editorial', compact('editorial'));
        }
        $editorial = ModelsEditorial_board::orderBy('member_id', 'desc')->paginate(10);
        return view('editorial_board.editorial', compact('editorial'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('editorial_board.editorial_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // member_name ="Deepan"
        // member_email =
        // member_role =
        // member_designation =
        // member_address =
        // member_researcharea =
        // member_country =
        // member_website =
        // member_image_url =


        $request->validate([
            'member_name' => 'required',
            'member_email' => 'required',
            'member_role' => 'required',
            'member_designation' => 'required',
            'member_address' => 'required',
            'member_researcharea' => 'required',
            'member_country' => 'required',
            'member_website' => 'nullable',
            'member_image_url' => 'required|file|mimes:png,jpg,jpeg,gif|max:20480',

        ]);


        $image = null;
        if ($request->hasFile('member_image_url')) {

            $image = $request->file('member_image_url')->store('editorial', 'public');
        }
        $record = ModelsEditorial_board::create([
            "member_name" => $request->member_name,
            "member_email" => $request->member_email,
            "member_role" => $request->member_role,
            "member_designation" => $request->member_designation,
            "member_address" => $request->member_address,
            "member_researcharea" => $request->member_researcharea,
            "member_country" => $request->member_country,
            "member_website" => $request->member_website,
            "member_image_url" => $image

        ]);

        return redirect()->route("editorial-home")->withSuccess("Editiorial-board Created Successfully!");
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
        $editorial = ModelsEditorial_board::find($id);
        return view('editorial_board.editorial_edit', compact('editorial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $validate =  Validator::make($request->all(), [
        //     'member_name' => 'required',
        //     'member_email' => 'required',
        //     'member_role' => 'required',
        //     'member_designation' => 'required',
        //     'member_address' => 'required',
        //     'member_researcharea' => 'required',
        //     'member_country' => 'required',
        //     'member_website' => 'nullable',
        // ]);

        // if ($validate->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validate) // Share the validation errors with the view
        //         ->withInput(); // Share the old input with the view (to retain values in the form)
        // }

        $record = ModelsEditorial_board::find($id);

        $image = $record->member_image_url;  // Keep the existing image by default

        // If a new file is uploaded, store the file and update the image path
        if ($request->hasFile('member_image_url')) {

            if ($image && Storage::disk('public')->exists($image)) {
                // Delete the old image from the storage
                Storage::disk('public')->delete($image);
            }
            // Store the new image
            $image = $request->file('member_image_url')->store('editorial', 'public');
        }


        $record->update([
            "member_name" => $request->member_name,
            "member_email" => $request->member_email,
            "member_role" => $request->member_role,
            "member_designation" => $request->member_designation,
            "member_address" => $request->member_address,
            "member_researcharea" => $request->member_researcharea,
            "member_country" => $request->member_country,
            "member_website" => $request->member_website,
            "member_image_url" => $image

        ]);

        return redirect()->route("editorial-home")->withSuccess("Editiorial-board Successfully Updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $edit = ModelsEditorial_board::find($id);

        $image = $edit->member_image_url;

        if ($image && Storage::disk('public')->exists($image)) {
            // Delete the old image from the storage
            Storage::disk('public')->delete($image);
        }
        
        $edit->delete();

        return redirect()->route('editorial-home')->withSuccess("Successfully deleted!");
    }
}
