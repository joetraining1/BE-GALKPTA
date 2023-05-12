<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\annual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnualController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $annuals = DB::table('annuals')->select('annuals.title', 'annuals.description')->get();

        if ($annuals->count() !== 0) {
            return response()->json([
                'status' => 'success',
                'result' => $annuals,
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

        $annualTry = DB::table('annuals')
        ->where('annuals.title', $request->title)
        ->get();

        if ($annualTry->count() < 1) {
            $annual = annual::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Annual leave registered successfully',
                'annual' => $annual,
            ]);
        } else {
            return response()->json([
                'status' => 'similar data',
                'message' => 'The data you are trying to create was already registered.',
            ]);
        }
    }

    public function show($id)
    {
        $annual = annual::find($id);

        if ($annual) {
            return response()->json([
                'status' => 'success',
                'result' => $annual,
            ]);
        } else {
            return response()->json([
                'status' => 'no data.',
                'message' => 'there are no data to be found.',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $annual = annual::find($id);

        if ($annual) {
            $annual->title = $request->title;
            $annual->description = $request->description;
            $annual->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Annual leave updated successfully',
                'annual' => $annual,
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
        $annual = annual::find($id);

        if ($annual) {
            
            $annual->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data deleted successfully',
                'annual' => $annual,
            ]);
        } else {
            return response()->json([
                'status' => 'no data.',
                'message' => 'there are no data to be found.',
            ]);
        }
    }
}
