<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\absence;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AbsenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $absences = absence::all();
        try{
            if($absences){
                return response()->json([
                    'status' => 'success',
                    'absences' => $absences,
                ]);
            }else{
                return response()->json([
                    'status' => 'no data.',
                    'message' => 'There are no data to be found.' 
                ]);
            }
        }catch(\Exception $e){
            abort(500, 'You need to login first');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $absence = absence::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Absence registered successfully',
            'absence' => $absence,
        ]);
    }

    public function show($id)
    {
        $absence = [absence::find($id)];
        try{
            if($absence){
                return response()->json([
                    'status' => 'success',
                    'absence' => $absence,
                ]);
            }else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'We are sorry, your data is nowhere to be found.',
                ]);
            }
        }catch(\Exception $e){
            throw new HttpException(500, $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $absence = absence::find($id);
        $absence->title = $request->title;
        $absence->description = $request->description;
        $absence->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Absence updated successfully',
            'absence' => $absence,
        ]);
    }

    public function destroy($id)
    {
        $absence = absence::find($id);
        try{
            if($absence){
                $absence->delete();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Absence removed successfully',
                    'absence' => $absence,
                ]);
            }else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'We are sorry, your data is nowhere to be found.',
                ]);
            }
        }catch(\Exception $e){
            abort(500, 'You need to login first.');
        }
    }
}
