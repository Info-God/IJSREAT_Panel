<?php

namespace App\Http\Controllers;

use App\Models\Archives;
use App\Models\blog;
use App\Models\Conference;
use App\Models\Conference_Categories;
use App\Models\Editorial_board;
use App\Models\Indexing;
use Illuminate\Http\Request;
use Illuminate\Support\Composer;

class DashboardController extends Controller
{
    public function index()
    {
        $index = Indexing::all()->count();
        $editorial = Editorial_board::all()->count();
        $archives = Archives::all()->count();
        $blog = blog::all()->count();
        $conference = Conference::all()->count();
        $conference_categories = Conference_Categories::all()->count();

        $data = [
            ["name" => "Indexing", "count" => $index],
            ["name" => "Editorial Board", "count" => $editorial],
            ["name" => "Archives", "count" => $archives],
            ["name" => "Blog", "count" => $blog],
            ["name" => "Conference Categories", "count" => $conference_categories],
            ["name" => "Conference", "count" => $conference],
        ];

        return view('dashboard.dashboard',compact("data"));
    }
}
