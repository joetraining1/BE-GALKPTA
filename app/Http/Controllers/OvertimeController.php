<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Overtime;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OvertimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $overtimes = DB::table('overtimes')
            ->join('users', 'overtimes.initiator_id', '=', 'users.id')
            ->join('todos', 'overtimes.todo_id', '=', 'todos.id')
            ->select()
            ->get();

        if ($overtimes->count() > 0) {
            return response()->json([
                'status' => 'success',
                'results' => $overtimes,
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
            'initiator_id' => 'required|int|max:20',
            'todo_id' => 'required|int|max:20',
            'duration' => 'required|string|max:255',
        ]);

        $initiator = User::find($request->initiator_id);
        $todo = Todo::find($request->todo_id);

        $overtime = Overtime::create([
            'initiator_id' => $initiator->id,
            'todo_id' => $todo->id,
            'duration' => $request->duration,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Overtime created successfully',
            'result' => $overtime,
        ]);
    }

    public function show($id)
    {
        $overtime = Overtime::find($id);
        if ($overtime) {
            return response()->json([
                'status' => 'success',
                'result' => $overtime,
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
            'initiator_id' => 'required|int|max:20',
            'todo_id' => 'required|int|max:20',
            'duration' => 'required|string|max:255',
        ]);

        $initiator = User::find($request->initiator_id);
        $todo = Todo::find($request->todo_id);

        $overtime = Overtime::find($id);

        if ($overtime) {
            $overtime->initiator_id = $initiator->id;
            $overtime->todo_id = $todo->id;
            $overtime->duration = $request->duration;
            $overtime->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Overtime updated successfully',
                'result' => $overtime,
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
        $overtime = Overtime::find($id);
        if ($overtime) {
            $overtime->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Overtime record removed successfully',
                'result' => $overtime,
            ]);
        } else {
            return response()->json([
                'status' => 'no data',
                'message' => 'there are no data to be found.'
            ]);
        }
    }
}
