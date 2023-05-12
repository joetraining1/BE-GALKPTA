<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\area;
use App\Models\deployment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeploymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $deployments = DB::table('deployments')
        ->join('areas', 'deployments.area_id', '=', 'areas.id')
        ->join('regions', 'areas.region_id', '=', 'regions.id')
        ->select('deployments.office', 'areas.name', 'regions.title')
        ->get();

        return response()->json([
            'status' => 'success',
            'deployments' => $deployments,
        ]);
    }

    public function show($id)
    {
        $deployment = deployment::find($id);
        if ($deployment) {
            return response()->json([
                'status' => 'success',
                'result' => $deployment,
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
            'area_id' => 'required|int|max:20',
            'office' => 'required|string|max:255',
        ]);

        $deployment = deployment::create([
            'area_id' => $request->area_id,
            'office' => $request->office,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Office Registered Successfully.',
            'deployment' => $deployment,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'area_id' => 'required|int|max:20',
            'office' => 'required|string|max:255',
        ]);

        $area = area::find($request->area_id);
        $deployment = deployment::find($id);

        $deployment->area_id = $area->id;
        $deployment->office = $request->office;

        $deployment->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Office updated successfully',
            'result' => $deployment,
        ]);
    }

    public function destroy($id)
    {
        $deployment = deployment::find($id);
        try{
            if($deployment){
                $deployment->delete();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Office removed successfully',
                    'result' => $deployment,
                ]);
            }else{
                return response()->json([
                    'status' => 'not found.',
                    'message' => 'We are sorry, your data is nowhere to be found.',
                ]);
            }
        }catch(\Exception $e){
            abort(500, 'You need to login first.');
        }
    }
}
