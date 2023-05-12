<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $departments = department::all();
        return response()->json([
            'status' => 'success',
            'departments' => $departments,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $department = department::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Department registered successfully',
            'department' => $department,
        ]);
    }

    public function show($id)
    {
        $department = department::find($id);
        return response()->json([
            'status' => 'success',
            'department' => $department,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $department = department::find($id);
        $department->title = $request->title;
        $department->description = $request->description;
        $department->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Department updated successfully',
            'department' => $department,
        ]);
    }

    public function destroy($id)
    {
        $department = department::find($id);
        $department->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Department removed successfully',
            'departmet' => $department,
        ]);
    }
}
