<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $statuses = status::all();
        return response()->json([
            'status' => 'success',
            'statuses' => $statuses,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $status = status::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Status type registered successfully',
            'result' => $status,
        ]);
    }

    public function show($id)
    {
        $status = status::find($id);
        if($status){
            return response()->json([
                'status' => 'success',
                'result' => $status,
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

        $status = status::find($id);
        $status->title = $request->title;
        $status->description = $request->description;
        $status->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status type updated successfully',
            'status' => $status,
        ]);
    }

    public function destroy($id)
    {
        $status = status::find($id);
        $status->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Status type removed successfully',
            'status' => $status,
        ]);
    }
}
