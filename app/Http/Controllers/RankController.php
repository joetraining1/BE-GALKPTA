<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\contract;
use App\Models\education;
use App\Models\position;
use App\Models\Rank;
use App\Models\role;
use App\Models\salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $ranks = DB::table('ranks')
            ->join('contracts', 'ranks.contract_id', '=', 'contracts.id')
            ->join('salaries', 'ranks.salary_id', '=', 'salaries.id')
            ->join('education', 'ranks.education_id', '=', 'education.id')
            ->join('roles', 'ranks.role_id', '=', 'roles.id')
            ->join('positions', 'ranks.position_id', '=', 'positions.id')
            ->select(
                'ranks.level', 
                'ranks.paid_leave', 
                'ranks.vacation', 
                'contracts.acronim', 
                'salaries.nominal', 
                'education.acronim', 
                'roles.title', 
                'positions.title')
            ->get();

        if ($ranks->count() > 0) {
            return response()->json([
                'status' => 'success',
                'result' => $ranks,
            ]);
        } else {
            return response()->json([
                'status' => 'no data',
                'message' => 'there are no data to be found.'
            ]);
        }
    }

    public function show($id)
    {
        $rank = Rank::find($id);
        if ($rank) {
            return response()->json([
                'status' => 'success',
                'result' => $rank,
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
            'contract_id' => 'required|int|max:20',
            'salary_id' => 'required|int|max:20',
            'education_id' => 'required|int|max:20',
            'role_id' => 'required|int|max:20',
            'position_id' => 'required|int|max:20',
            'level' => 'required|string|max:255',
            'paid_leave' => 'required|string|max:255',
            'vacation' => 'required|string|max:255',
        ]);

        $contract = contract::find($request->contract_id);
        $salary = salary::find($request->salary_id);
        $education = education::find($request->education_id);
        $role = role::find($request->role_id);
        $position = position::find($request->position_id);
        $rank = Rank::create([
            'contract_id' => $contract->id,
            'salary_id' => $salary->id,
            'education_id' => $education->id,
            'role_id' => $role->id,
            'position_id' => $position->id,
            'level' => $request->level,
            'paid_leave' => $request->paid_leave,
            'vacation' => $request->vacation,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Rank created successfully',
            'result' => $rank,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'contract_id' => 'required|int|max:20',
            'salary_id' => 'required|int|max:20',
            'education_id' => 'required|int|max:20',
            'role_id' => 'required|int|max:20',
            'position_id' => 'required|int|max:20',
            'level' => 'required|string|max:255',
            'paid_leave' => 'required|string|max:255',
            'vacation' => 'required|string|max:255',
        ]);

        $contract = contract::find($request->contract_id);
        $salary = salary::find($request->salary_id);
        $education = education::find($request->education_id);
        $role = role::find($request->role_id);
        $position = position::find($request->position_id);
        $rank = Rank::find($id);

        if ($rank) {
            $rank->contract_id = $contract->id;
            $rank->salary_id = $salary->id;
            $rank->education_id = $education->id;
            $rank->role_id = $role->id;
            $rank->position_id = $position->id;
            $rank->level = $request->level;
            $rank->paid_leave = $request->paid_leave;
            $rank->vacation = $request->vacation;

            $rank->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Rank updated successfully',
                'result' => $rank,
            ]);
        } else {
            return response()->json([
                'status' => 'no data',
                'message' => 'there are no data to be found.'
            ]);
        }
    }

    public function destroy($id)
    {
        $rank = Rank::find($id);
        try {
            if ($rank) {
                $rank->delete();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Rank removed successfully',
                    'result' => $rank,
                ]);
            } else {
                return response()->json([
                    'status' => 'no data',
                    'message' => 'there are no data to be found.'
                ]);
            }
        } catch (\Exception $e) {
            abort(500, 'You need to login first.');
        }
    }
}
