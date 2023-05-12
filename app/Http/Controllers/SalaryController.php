<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $salaries = salary::all();
        return response()->json([
            'status' => 'success',
            'salaries' => $salaries,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nominal' => 'required|string|max:255',
        ]);

        $salary = salary::create([
            'nominal' => $request->nominal,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Salary nominal registered successfully',
            'salary' => $salary,
        ]);
    }

    public function show($id)
    {
        $salary = salary::find($id);
        return response()->json([
            'status' => 'success',
            'salary' => $salary,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|string|max:255',
        ]);

        $salary = salary::find($id);
        $salary->nominal = $request->nominal;
        $salary->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Salary nominal updated successfully',
            'salary' => $salary,
        ]);
    }

    public function destroy($id)
    {
        $salary = salary::find($id);
        $salary->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Salary nominal removed successfully',
            'salary' => $salary,
        ]);
    }
}
