<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\role;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $todos = DB::table('todos')
            ->join('departments', 'todos.department_id', '=', 'departments.id')
            ->join('roles', 'todos.role_id', '=', 'roles.id')
            ->select('departments.title as department', 'roles.title as role', 'todos.title', 'todos.description')
            ->get();

        if ($todos->count() > 0) {
            return response()->json([
                'status' => 'success',
                'results' => $todos,
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
            'department_id' => 'required|int|max:20',
            'role_id' => 'required|int|max:20',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $department = department::find($request->department_id);
        $role = role::find($request->role_id);

        $todo = Todo::create([
            'department_id' => $department->id,
            'role_id' => $role->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Todo created successfully',
            'todo' => $todo,
        ]);
    }

    public function show($id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            return response()->json([
                'status' => 'success',
                'todo' => $todo,
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
            'department_id' => 'required|int|max:20',
            'role_id' => 'required|int|max:20',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $department = department::find($request->department_id);
        $role = role::find($request->role_id);
        $todo = Todo::find($id);

        if ($todo) {
            $todo->department_id = $department->id;
            $todo->role_id = $role->id;
            $todo->title = $request->title;
            $todo->description = $request->description;
            $todo->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Todo updated successfully',
                'todo' => $todo,
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
        $todo = Todo::find($id);
        if ($todo) {
            $todo->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Todo deleted successfully',
                'todo' => $todo,
            ]);
        } else {
            return response()->json([
                'status' => 'no data.',
                'message' => 'there are no data to be found.',
            ]);
        }
    }
}
