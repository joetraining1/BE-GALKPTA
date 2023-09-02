<?php

namespace App\Http\Controllers;

use App\Models\type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'testApi']]);
    }

    public function testApi(Request $request){
        return response()->json([
            'message' => 'you are connected to this api.'
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials, ['exp' => Carbon::now()->addDays(7)->timestamp]);

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        $userType = type::find($user->type_id);
        $userData = [
            'name' => $user->name,
            'type' => $userType->title,
        ];

        return response()->json([
            'status' => 'success',
            'user' => $userData,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'department_id' => 'int|max:20',
            'rank_id' => 'int|max:20',
            'deployment_id' => 'int|max:20',
            'bank_id' => 'int|max:20',
            'type_id' => 'int|max:20',
            'name' => 'required|string|max:255',
            'phone' => 'string|max:255',
            'gender' => 'string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'bank_account' => 'string|max:255',
            'password' => 'required|string|min:6',
            'alamat' => 'string|max:255',
        ]);

        $user = User::create([
            'department_id' => $request->department_id,
            'rank_id' => $request->rank_id,
            'deployment_id' => $request->deployment_id,
            'bank_id' => $request->bank_id,
            'type_id' => $request->type_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'email' => $request->email,
            'bank_account' => $request->bank_account,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat
        ]);

        // $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                // 'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json([
                'status' => 'success',
                'result' => $user,
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
            'department_id' => 'int|max:20',
            'rank_id' => 'int|max:20',
            'deployment_id' => 'int|max:20',
            'bank_id' => 'int|max:20',
            'type_id' => 'int|max:20',
            'name' => 'string|max:255',
            'phone' => 'string|max:255',
            'gender' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'bank_account' => 'string|max:255',
            'password' => 'string|min:6',
            'alamat' => 'string|max:255',
        ]);

        $user = User::find($id);
        if ($user) {
            $user->department_id = $request->department_id ? $request->department_id : $user->department_id;
            $user->rank_id = $request->rank_id ? $request->rank_id : $user->rank_id;
            $user->deployment_id = $request->deployment_id ? $request->deployment_id : $user->deployment_id;
            $user->bank_id = $request->bank_id ? $request->bank_id : $user->bank_id;
            $user->type_id = $request->type_id ? $request->type_id : $user->type_id;
            $user->name = $request->name ? $request->name : $user->name;
            $user->phone = $request->phone ? $request->phone : $user->phone;
            $user->gender = $request->gender ? $request->gender : $user->gender;
            $user->email = $request->email ? $request->email : $user->email;
            $user->bank_account = $request->bank_account ? $request->bank_account : $user->bank_account;
            $user->password = $request->password ? $request->password : $user->password;
            $user->alamat = $request->alamat ? $request->alamat : $user->alamat;
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully',
                'user' => $user,
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
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'User record removed successfully',
                'result' => $user,
            ]);
        } else {
            return response()->json([
                'status' => 'no data',
                'message' => 'there are no data to be found.'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out.',
        ]);
    }
    public function me()
    {
        return response()->json(auth()->user());
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
