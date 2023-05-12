<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $roles = role::all();
        return response()->json([
            'status' => 'success',
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $role = role::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Role type registered successfully',
            'role' => $role,
        ]);
    }

    public function show($id)
    {
        $role = role::find($id);
        return response()->json([
            'status' => 'success',
            'role' => $role,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $role = role::find($id);
        $role->title = $request->title;
        $role->description = $request->description;
        $role->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Role type updated successfully',
            'role' => $role,
        ]);
    }

    public function destroy($id)
    {
        $role = role::find($id);
        $role->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User type removed successfully',
            'role' => $role,
        ]);
    }
}
