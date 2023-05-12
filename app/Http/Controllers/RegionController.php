<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $regions = region::all();
        if($regions->count() > 0){
            return response()->json([
                'status' => 'success',
                'regions' => $regions,
            ]);
        } else {
            return response()->json([
                'status' => 'no data.',
                'message' => 'there are no data to be found.',
            ]);
        }
    }

    public function show($id)
    {
        $region = region::find($id);
        if ($region) {
            return response()->json([
                'status' => 'success',
                'result' => $region,
            ]);
        } else {
            return response()->json([
                'status' => 'no data.',
                'message' => 'there are no data to be found.',
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $region = region::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Region Registered successfully.',
            'region' => $region,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $region = region::find($id);
        if ($region) {
            $region->title = $request->title;
            $region->description = $request->description;
            $region->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Region updated successfully',
                'result' => $region,
            ]);
        } else {
            return response()->json([
                'status' => 'no data.',
                'message' => 'there are no data to be found.',
            ]);
        }
    }

    public function destroy($id)
    {
        $region = region::find($id);
        if ($region) {
            $region->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Region removed successfully',
                'result' => $region,
            ]);
        } else {
            return response()->json([
                'status' => 'no data',
                'message' => 'there are no data to be found.'
            ]);
        }
    }
}
