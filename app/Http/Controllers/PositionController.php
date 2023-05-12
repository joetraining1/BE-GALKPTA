<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $positions = position::all();
        return response()->json([
            'status' => 'success',
            'positions' => $positions,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $position = position::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Position registered successfully',
            'position' => $position,
        ]);
    }

    public function show($id)
    {
        $position = position::find($id);
        return response()->json([
            'status' => 'success',
            'position' => $position,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $position = position::find($id);
        $position->title = $request->title;
        $position->description = $request->description;
        $position->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Position details updated successfully',
            'position' => $position,
        ]);
    }

    public function destroy($id)
    {
        $position = position::find($id);
        $position->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User type removed successfully',
            'position' => $position,
        ]);
    }
}
