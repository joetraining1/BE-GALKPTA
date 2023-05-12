<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\classification;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $reports = DB::table('reports')
            ->join('users', 'reports.user_id', '=', 'users.id')
            ->join('classifications', 'reports.class_id', '=', 'classifications.id')
            ->select()
            ->get();

        if ($reports->count() > 0) {
            return response()->json([
                'status' => 'success',
                'results' => $reports,
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
            'reviewer_id' => 'required|int|max:20',
            'class_id' => 'required|int|max:20',
            'ondays' => 'required|string|max:255',
            'offdays' => 'required|string|max:255',
            'overtimes' => 'required|string|max:255',
            'summary' => 'required|string|max:255',
            'review' => 'string',
        ]);

        $user = User::find($request->user_id);
        $reviewer = User::find($request->reviewer_id);
        $class = classification::find($request->class_id);

        $report = Report::create([
            'user_id' => $user->id,
            'reviewer_id' => $reviewer->id,
            'class_id' => $class->id,
            'ondays' => $request->ondays,
            'offdays' => $request->offdays,
            'overtimes' => $request->overtimes,
            'summary' => $request->summary,
            'review' => $request->review,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Report created successfully',
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
            'user_id' => 'required|int|max:20',
            'reviewer_id' => 'required|int|max:20',
            'class_id' => 'required|int|max:20',
            'ondays' => 'required|string|max:255',
            'offdays' => 'required|string|max:255',
            'overtimes' => 'required|string|max:255',
            'summary' => 'required|string|max:255',
            'review' => 'string',
        ]);

        $user = User::find($request->user_id);
        $reviewer = User::find($request->reviewer_id);
        $class = classification::find($request->class_id);
        $report = Report::find($id);

        if ($report) {
            $report->user_id = $user->id;
            $report->reviewer_id = $reviewer->id;
            $report->class_id = $class->id;
            $report->ondays = $request->ondays;
            $report->offdays = $request->offdays;
            $report->overtimes = $request->overtimes;
            $report->summary = $request->summary;
            $report->review = $request->review;
            $report->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Report record updated successfully',
                'result' => $report,
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
                'message' => 'Report record removed successfully',
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
