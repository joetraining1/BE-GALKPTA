<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\area;
use App\Models\region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $areas = DB::table('areas')
            ->join('regions', 'areas.region_id', '=', 'regions.id')
            ->select('areas.name', 'regions.title', 'regions.description')
            ->get();

        return response()->json([
            'status' => 'success',
            'areas' => $areas,
        ]);
    }

    public function show($id)
    {
        $area = area::find($id);
        if ($area) {
            return response()->json([
                'status' => 'success',
                'result' => $area,
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
            'region_id' => 'required|int|max:20',
            'name' => 'required|string|max:255',
        ]);

        $region = region::find($request->region_id);
        if(!$region){
            return response()->json([
                'status' => 'not found.',
                'message' => 'Region data is nowhere to be found.',
            ]);
        }
        $area = area::create([
            'region_id' => $region->id,
            'name' => $request->name,
        ]);

        // $area = $region->id;

        return response()->json([
            'status' => 'success',
            'message' => 'Area created successfully',
            'area' => $area,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'region_id' => 'required|int|max:20',
            'name' => 'required|string|max:255',
        ]);

        $region = region::find($request->region_id);
        $area = area::find($id);

        $area->region_id = $region->id;
        $area->name = $request->name;

        $area->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Area updated successfully',
            'result' => $area,
        ]);
    }

    public function destroy($id)
    {
        $area = area::find($id);
        try{
            if($area){
                $area->delete();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Area removed successfully',
                    'result' => $area,
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
