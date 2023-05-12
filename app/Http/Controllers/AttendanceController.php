<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\status;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $attendances = DB::table('attendances')
            ->join('users', 'attendances.user_id', '=', 'users.id')
            ->join('statuses', 'attendances.status_id', '=', 'statuses.id')
            ->select('attendances.id', 'users.name', 'statuses.title', 'attendances.created_at')
            ->get();

        // $allAttendances = DB::table('attendances')
        // ->select('user_id', 'status_id', 'created_at')
        // ->get();

        return response()->json([
            'status' => 'success',
            'result' => $attendances,
        ]);
    }

    public function show($id)
    {
        $attendance = Attendance::find($id);
        return response()->json([
            'status' => 'success',
            'result' => $attendance,
        ]);
    }

    public function uShow()
    {
        $user = auth()->user();
        $attendance = DB::table('attendances')
            ->join('users', 'attendances.user_id', '=', 'users.id')
            ->join('statuses', 'attendances.status_id', '=', 'statuses.id')
            ->select('attendances.id', 'users.name', 'statuses.title', 'attendances.created_at')
            ->where('attendances.user_id', '=', $user->id)
            ->get();
            
        return response()->json([
            'status' => 'success',
            'result' => $attendance,
        ]);
    }

    public function store()
    {
        $user = auth()->user();

        $attendance = Attendance::create([
            'user_id' => $user->id
        ]);

        $number = Carbon::parse($attendance->created_at);
        $hour = $number->hour;
        $minute = $number->minute;

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'berhasil'
        // ]);

        if ($hour < 16 && $hour > 7) {
            if ($hour <= 9 && $hour >= 8) {
                $attId = 1;
                $status = status::find($attId);

                $attendance->status_id = $status->id;
                $attendance->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'User attended successfully',
                    'result' => $attendance,
                ]);
            } elseif ($hour <= 8 && $hour >= 7) {
                $attId = 2;
                $status = status::find($attId);

                $attendance->status_id = $status->id;
                $attendance->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'User attended successfully',
                    'result' => $attendance,
                ]);
            } elseif ($hour < 7) {
                $attendance->delete();
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Jam kerja belum dimulai',
                ]);
            } else {
                $attId = 3;
                $status = status::find($attId);

                $attendance->status_id = $status->id;
                $attendance->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'User attended successfully',
                    'result' => [$attendance, $user]
                ]);
            }
        } else {
            $attendance->delete();
            return response()->json([
                'status' => 'fail',
                'message' => 'jam kerja sudah terlewat.',
            ]);
        }
    }

    public function destroy($id)
    {
        $attendance = Attendance::find($id);
        try {
            if ($attendance) {
                $attendance->delete();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Attendance record removed successfully',
                    'result' => $attendance,
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
