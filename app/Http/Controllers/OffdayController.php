<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\absence;
use App\Models\annual;
use App\Models\Offday;
use App\Models\status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OffdayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $offdays = DB::table('offdays')
            ->join('users',         'offdays.user_id', '=', 'users.id')
            ->join('absences',      'offdays.absence_id', '=', 'absences.id')
            ->join('annuals',    'offdays.annual_id', '=', 'annuals.id')
            ->join('statuses',         'offdays.status_id', '=', 'statuses.id')
            ->select()
            ->get();

        return response()->json([
            'status' => 'success',
            'result' => $offdays,
        ]);
    }

    public function show($id)
    {
        $offday = Offday::find($id);
        return response()->json([
            'status' => 'success',
            'result' => $offday,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|int|max:20',
            'permitter_id' => 'int|max:20',
            'absence_id' => 'required|int|max:20',
            'annual_id' => 'required|int|max:20',
            'status_id' => 'int|max:20',
            'start_date' => 'required|string|max:255',
            'comeback' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
        ]);

        $user = User::find($request->user_id);
        $permitter = User::find($request->permitter_id);
        $absence = absence::find($request->absence_id);
        $annual = annual::find($request->annual_id);
        $status = status::find($request->status_id);

        if($permitter && $status){
            $altOffday = DB::table('offdays')
            ->insert([
                'user_id' => $user->id,
                'permitter_id' => $permitter->id,
                'absence_id' => $absence->id,
                'annual_id' => $annual->id,
                'status_id' => $status->id,
                'start_date' => $request->start_date,
                'comeback' => $request->comeback,
                'reason' => $request->reason
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Offday request created successfully',
                'result' => $altOffday
            ]);
        }else{
            $offday = Offday::create([
                'user_id' => $user->id,
                'absence_id' => $absence->id,
                'annual_id' => $annual->id,
                'start_date' => $request->start_date,
                'comeback' => $request->comeback,
                'reason' => $request->reason,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Offday request created successfully',
                'result' => $offday,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|int|max:20',
            'permitter_id' => 'int|max:20',
            'absence_id' => 'required|int|max:20',
            'annual_id' => 'required|int|max:20',
            'status_id' => 'int|max:20',
            'position_id' => 'required|int|max:20',
            'start_date' => 'required|string|max:255',
            'comeback' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
        ]);

        $user = User::find($request->user_id);
        $permitter = User::find($request->permitter_id);
        $absence = absence::find($request->salary_id);
        $annual = annual::find($request->education_id);
        $status = status::find($request->role_id);
        $offday = Offday::find($id);

        $offday->user_id = $user->id;
        $offday->permitter_id = $permitter->id;
        $offday->absence_id = $absence->id;
        $offday->annual_id = $annual->id;
        $offday->status_id = $status->id;
        $offday->start_date = $request->start_date;
        $offday->comeback = $request->comeback;
        $offday->reason = $request->reason;

        $offday->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Offday request updated successfully',
            'result' => $offday,
        ]);
    }

    public function destroy($id)
    {
        $offday = Offday::find($id);
        try {
            if ($offday) {
                $offday->delete();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Offday request removed successfully',
                    'result' => $offday,
                ]);
            } else {
                return response()->json([
                    'status' => 'success',
                    'message' => 'We are sorry, your data is nowhere to be found.',
                ]);
            }
        } catch (\Exception $e) {
            abort(500, 'You need to login first.');
        }
    }
}
