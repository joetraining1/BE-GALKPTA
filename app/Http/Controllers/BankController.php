<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $banks = Bank::all();
        if ($banks->count() !== 0) {
            return response()->json([
                'status' => 'success',
                'banks' => $banks,
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
            'acronim' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        $banks = DB::table('banks')
            ->where('banks.name', $request->name)
            ->get();

        if ($banks->count() < 1) {
            $bank = Bank::create([
                'acronim' => $request->acronim,
                'name' => $request->name,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Bank registered successfully',
                'bank' => $bank,
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
        $bank = Bank::find($id);
        if ($bank) {
            return response()->json([
                'status' => 'success',
                'result' => $bank,
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
            'acronim' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        $bank = Bank::find($id);
        if ($bank) {
            $bank->acronim = $request->acronim;
            $bank->name = $request->name;
            $bank->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Bank Updated successfully',
                'result' => $bank,
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
        $bank = Bank::find($id);
        if ($bank) {
            $bank->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Bank removed successfully',
                'bank' => $bank,
            ]);
        } else {
            return response()->json([
                'status' => 'no data',
                'message' => 'there are no data to be found.'
            ]);
        }
    }
}
