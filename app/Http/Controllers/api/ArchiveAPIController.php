<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Archives;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArchiveAPIController extends Controller
{
    public function archiveList()
    {

        $data = Archives::select("*")->get();
        $domainName = 'https://ijsreat.com/archiver/';
        $data->transform(function ($item) use ($domainName) {
            $item->paper_url = $domainName . $item->paper_url; // Prepend the hardcoded base URL to paper_url
            return $item;
        });
        if (!$data) {
            return response()->json([
                'message' => 'Data Not Found!'
            ], 404);
        }

        return response()->json($data, 200);
    }
    public function archiveUnique(Request $request)
    {
        $header = $request->header("Authorization");
        if (empty($header)) {
            $message = "Unauthenticated";
            return response()->json(["error" => $message], 404);
        } elseif ($header == "e1b3d61a14729026509aee1c291c8965f928ab08c5cc2562b46bc6962834983b") {
            $data = Archives::select("year", "volume", "issue")
                ->distinct()
                ->orderBy('year', 'desc')
                ->orderBy('volume', 'desc')
                ->orderBy('issue', 'desc')
                ->get();

            if ($data->isEmpty()) {
                return response()->json([
                    'message' => 'Data Not Found!'
                ], 404);
            }

            // Transform the data into the desired structure
            $result = [];
            foreach ($data as $archive) {
                $year = $archive->year;
                $volume = $archive->volume;
                $issue = $archive->issue;

                if (!isset($result[$year])) {
                    $result[$year] = [];
                }

                if (!isset($result[$year][$volume])) {
                    $result[$year][$volume] = [];
                }

                $result[$year][$volume][] = $issue;
            }

            return response()->json(['archives' => $result], 200);
        } else {
            $message = "Unauthenticated";
            return response()->json(["error" => $message], 404);
        }
    }

    public function archiveFetch(Request $request)
    {
        $header = $request->header("Authorization");
        if (empty($header)) {
            $message = "Unauthenticated";
            return response()->json(["error" => $message], 404);
        } elseif ($header == "e1b3d61a14729026509aee1c291c8965f928ab08c5cc2562b46bc6962834983b") {
            $validate = Validator::make($request->all(), [
                'year' => 'required',
                'volume' => 'required',
                'issue' => 'required'
            ]);

            if ($validate->fails()) {
                return response()->json(['errors' => $validate->errors()], 404);
            }

            $data = Archives::where("year", $request->year)
                ->where("volume", $request->volume)
                ->where("issue", $request->issue)
                ->get();

            if ($data->isEmpty()) {
                return response()->json([
                    'message' => 'Data Not Found!'
                ], 404);
            }

            $domainName = 'https://ijsreat.com/archiver/';

            // Modify the data to include the full URL for the paper_url
            $data->transform(function ($item) use ($domainName) {
                $item->paper_url = $domainName . $item->paper_url; // Prepend the hardcoded base URL to paper_url
                return $item;
            });

            return response()->json(['papersList' => $data], 200);
        } else {
            $message = "Unauthenticated";
            return response()->json(["error" => $message], 404);
        }
    }

    public function archiveGet(Request $request)
    {

        $header = $request->header("Authorization");
        if (empty($header)) {
            $message = "Unauthenticated";
            return response()->json(["error" => $message], 404);
        } elseif ($header == "e1b3d61a14729026509aee1c291c8965f928ab08c5cc2562b46bc6962834983b") {
            $validate = Validator::make($request->all(), [
                'paperid' => 'required',
            ]);

            if ($validate->fails()) {
                return response()->json(['errors' => $validate->errors()], 404);
            }

            $data = Archives::where("paper_id", $request->paperid)->first();

            if (!$data) {
                return response()->json([
                    'message' => 'Data Not Found!'
                ], 404);
            }

            $domainName = 'https://ijsreat.com/archiver/';

            // Reformat the data as needed
            $formattedData = [
                'created_time' => $data->created_at->format('Y-m-d'),
                'paper_abstract' => $data->paper_abstract,
                'paper_doi' => $data->paper_doi,
                'paper_uniqueid' => $data->paper_uniqueid ?? '20033',  // Default value
                'paper_articletype' => $data->paper_articletype,
                'modified_time' => $data->updated_at->format('Y-m-d'),
                'is_deleted' => $data->is_deleted ? 'true' : 'false',
                'paper_url' => $domainName . $data->paper_url,  // Use hardcoded domain
                'paper_pages' => $data->paper_pages,
                'paper_title' => $data->paper_title,
                'paper_author' => $data->paper_author,
                'paper_month' => $data->paper_month,
            ];

            return response()->json(['paperdetails' => $formattedData], 200);
        } else {
            $message = "Unauthenticated";
            return response()->json(["error" => $message], 404);
        }
    }





}



