<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\execution;
use App\Models\User;
use App\Models\warning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExecutionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $executions = DB::table('executions')
            ->join('users', 'executions.user_id', '=', 'users.id')
            ->join('warnings', 'executions.warning_id', '=', 'warnings.id')
            ->select()
            ->get();

        if ($executions->count() > 0) {
            return response()->json([
                'status' => 'success',
                'results' => $executions,
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
            'executioner_id' => 'required|int|max:20',
            'warning_id' => 'required|int|max:20',
            'notes' => 'required|string',
        ]);

        $user = User::find($request->user_id);
        $executioner = User::find($request->executioner_id);
        $warning = warning::find($request->warning_id);

        if($user && $executioner && $warning){
            $execution = execution::create([
                'user_id' => $user->id,
                'executioner_id' => $executioner->id,
                'warning_id' => $warning->id,
                'notes' => $request->notes
            ]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Execution delivered successfully',
                'result' => $execution,
            ]);
        }else{
            return response()->json([
                'status' => 'no data.',
                'message' => 'there are no data to be found.',
            ]);
        }

    }

    public function show($id)
    {
        $execution = execution::find($id);
        if ($execution) {
            return response()->json([
                'status' => 'success',
                'result' => $execution,
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
            'executioner_id' => 'required|int|max:20',
            'warning_id' => 'required|int|max:255',
            'notes' => 'required|string',
        ]);

        $user = User::find($request->user_id);
        $executioner = User::find($request->executioner_id);
        $warning = warning::find($request->warning_id);
        $execution = execution::find($id);

        if ($execution) {
            $execution->user_id = $user->id;
            $execution->executioner_id = $executioner->id;
            $execution->warning_id = $warning->id;
            $execution->notes = $request->notes;
            $execution->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Execution updated successfully',
                'result' => $execution,
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
        $execution = execution::find($id);
        if ($execution) {
            $execution->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Execution removed successfully',
                'result' => $execution,
            ]);
        } else {
            return response()->json([
                'status' => 'no data.',
                'message' => 'there are no data to be found.',
            ]);
        }
    }
}
