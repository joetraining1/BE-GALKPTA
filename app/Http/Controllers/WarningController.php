<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\warning;
use Illuminate\Http\Request;

class WarningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $warnings = warning::all();
        return response()->json([
            'status' => 'success',
            'warnings' => $warnings,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $warning = warning::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Warning registered successfully',
            'warning' => $warning,
        ]);
    }

    public function show($id)
    {
        $warning = warning::find($id);
        if($warning){
            return response()->json([
                'status' => 'success',
                'warning' => $warning,
            ]);
        } else {
            return response()->json([
                'status' => 'no data.',
                'message' => 'Data is nowhere to be found.',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $warning = warning::find($id);
        $warning->title = $request->title;
        $warning->description = $request->description;
        $warning->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Warning updated successfully',
            'warning' => $warning,
        ]);
    }

    public function destroy($id)
    {
        $warning = warning::find($id);
        $warning->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Warning removed successfully',
            'warning' => $warning,
        ]);
    }
}
