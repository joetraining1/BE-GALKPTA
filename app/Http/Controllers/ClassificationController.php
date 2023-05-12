<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\classification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $classes = classification::all();
        if ($classes->count() !== 0) {
            return response()->json([
                'status' => 'success',
                'result' => $classes,
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

        $classes = DB::table('classifications')
            ->where('classifications.title', $request->title)
            ->get();

        if ($classes->count() < 1) {
            $class = classification::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Classifications registered successfully',
                'result' => $class,
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
        $class = classification::find($id);
        if ($class) {
            return response()->json([
                'status' => 'success',
                'result' => $class,
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

        $classification = classification::find($id);
        if ($classification) {
            $classification->title = $request->title;
            $classification->description = $request->description;
            $classification->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Classification updated successfully',
                'classification' => $classification,
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
        $classification = classification::find($id);
        if ($classification) {
            $classification->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Classification removed successfully',
                'classifications' => $classification,
            ]);
        } else {
            return response()->json([
                'status' => 'no data',
                'message' => 'there are no data to be found.'
            ]);
        }
    }
}
