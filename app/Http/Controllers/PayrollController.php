<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $payrolls = DB::table('payrolls')
            ->join('reports', 'payrolls.report_id', '=', 'reports.id')
            ->get();

        if ($payrolls->count() > 0) {
            return response()->json([
                'status' => 'success',
                'results' => $payrolls,
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
            'report_id' => 'required|int|max:20',
            'nominal' => 'required|string|max:255',
        ]);

        $report = Report::find($request->report_id);

        $payroll = Payroll::create([
            'report_id' => $report->id,
            'nominal' => $request->nominal,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Overtime created successfully',
            'result' => $report,
        ]);
    }

    public function show($id)
    {
        $report = Report::find($id);
        if ($report) {
            return response()->json([
                'status' => 'success',
                'result' => $report,
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
            'report_id' => 'required|int|max:20',
            'nominal' => 'required|string|max:255',
        ]);

        $report = Report::find($request->report_id);

        $payroll = Payroll::find($id);

        if ($payroll) {
            $payroll->report_id = $report->id;
            $payroll->nominal = $request->nominal;
            $payroll->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Overtime updated successfully',
                'result' => $payroll,
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
        $report = Report::find($id);
        if ($report) {
            $report->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Overtime record removed successfully',
                'result' => $report,
            ]);
        } else {
            return response()->json([
                'status' => 'no data',
                'message' => 'there are no data to be found.'
            ]);
        }
    }
}