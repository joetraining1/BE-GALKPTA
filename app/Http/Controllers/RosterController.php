<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\department;
use App\Models\Overtime;
use App\Models\role;
use App\Models\Roster;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RosterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $rosters = DB::table('rosters')
            ->join('users', 'rosters.user_id', '=', 'users.id')
            ->join('overtimes', 'rosters.ovt_id', '=', 'overtimes.id')
            ->select()
            ->get();

        if ($rosters->count() !== 0) {
            return response()->json([
                'status' => 'success',
                'results' => $rosters,
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
            'user_id' => 'required|int|max:20',
            'ovt_id' => 'required|int|max:20'
        ]);

        $user = User::find($request->user_id);
        $overtime = Overtime::find($request->ovt_id);

        if ($user && $overtime) {
            $roster = Roster::create([
                'user_id' => $user->id,
                'ovt_id' => $overtime->id
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Roster registered successfully',
                'result' => $roster,
            ]);
        } else {
            return response()->json([
                'status' => 'no data.',
                'message' => 'there are no data to be found.',
            ]);
        }
    }

    public function show($id)
    {
        $roster = Roster::find($id);
        if ($roster) {
            return response()->json([
                'status' => 'success',
                'result' => $roster,
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
            'user_id' => 'required|int|max:20',
            'ovt_id' => 'required|int|max:20',
        ]);

        $user = User::find($request->user_id);
        $overtime = Overtime::find($request->ovt_id);
        $roster = Roster::find($id);

        if ($roster) {
            $roster->user_id = $user->id;
            $roster->ovt_id = $overtime->id;
            $roster->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Roster updated successfully',
                'result' => $roster,
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
        $roster = Roster::find($id);
        if ($roster) {
            $roster->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Roster removed successfully',
                'result' => $roster,
            ]);
        } else {
            return response()->json([
                'status' => 'no data.',
                'message' => 'there are no data to be found.',
            ]);
        }
    }
}
