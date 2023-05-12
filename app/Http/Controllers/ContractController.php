<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $contracts = contract::all();
        if ($contracts->count() !== 0) {
            return response()->json([
                'status' => 'success',
                'result' => $contracts,
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
            'acronim' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $contracts = DB::table('contracts')
            ->where('contracts.title', $request->title)
            ->get();

        if ($contracts->count() < 1) {
            $contract = contract::create([
                'title' => $request->title,
                'acronim' => $request->acronim,
                'description' => $request->description,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Contract type registered successfully',
                'result' => $contract,
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
        $contract = contract::find($id);
        if ($contract) {
            return response()->json([
                'status' => 'success',
                'result' => $contract,
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
            'acronim' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $contract = contract::find($id);
        if ($contract) {

            $contract->title = $request->title;
            $contract->acronim = $request->acronim;
            $contract->description = $request->description;
            $contract->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Contract type updated successfully',
                'contract' => $contract,
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
        $contract = contract::find($id);
        if ($contract) {
            $contract->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Contract type removed successfully',
                'contract' => $contract,
            ]);
        } else {
            return response()->json([
                'status' => 'no data',
                'message' => 'there are no data to be found.'
            ]);
        }
    }
}
