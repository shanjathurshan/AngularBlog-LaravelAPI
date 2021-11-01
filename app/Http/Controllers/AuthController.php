<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(){
        return User::all();
    }

    public function loggedInUser(Request $request){
        $user = Auth::user();
        if(Auth::user()){
            return "hello";
        } else {
            return "nop";
        }
        // return $request->user();
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|unique:users|email',
            'password' => 'required|string',
        ]);    

        // if($validator->fails()){
        //     return response()->json($validator->errors());
        // }

        if($validator->fails()){
            return response([
                'errorMessage' => true,
                'message' => 'Validator Error'
            ]);
        }

        // $user = User::create([
        //     'name' => $validator['name'],
        //     'email' => $validator['email'],
        //     'password' => bcrypt($validator['password']),
        // ]);

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        // return response($response, 201);
        return response()->json([
            'message' => true,
            'token' => $token,
            'user' => $user
        ], 201);
        // return response(['user' => $response['user'], 'access_token' => $response['token']]);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if( !$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds!'
            ], 401);

        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out!'
        ];
    }

    public function destroy($id){
        return User::destroy($id);
    }

    public function getById($id){
        $user = User::find($id);
        return $user;
    }

}
