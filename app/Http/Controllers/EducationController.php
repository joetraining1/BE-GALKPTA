<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $educations = DB::table('education')->get();
        if($educations->count() > 0){
            return response()->json([
                'status' => 'success',
                'result' => $educations,
            ]);
            
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'There are no data to be found.',
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'acronim' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $education = education::create([
            'acronim' => $request->acronim,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Education level registered successfully',
            'education' => $education,
        ]);
    }

    public function show($id)
    {
        $education = education::find($id);
        return response()->json([
            'status' => 'success',
            'education' => $education,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'acronim' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $education = education::find($id);
        $education->acronim = $request->acronim;
        $education->title = $request->title;
        $education->description = $request->description;
        $education->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Education level updated successfully',
            'education' => $education,
        ]);
    }

    public function destroy($id)
    {
        $education = education::find($id);
        $education->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Education level removed successfully',
            'education' => $education,
        ]);
    }
}
