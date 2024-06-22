<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Exception;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->ismethod("post")) {
            try {
                $validation = Validator::make($request->all(), [
                    "email" => 'required|email|exists:users',
                    "password" => "string|required|min:6"
                ]);
                if ($validation->fails()) {
                    return response()->json([
                        'sucsess' => 0,
                        'result' => null,
                        'message' => $validation->errors(),
                    ], 200);
                }
                $token = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
                if (!$token) {
                    /*  return response()->json([
                        'sucsess' => 0,
                        'result' => null,
                        'message' => 'register first',
                    ], 200);*/
                    return to_route('login')->with('error', 'Invalid login');
                } else {
                    /*   $user = User::where('email', $request->email)->first();
                    return response()->json([
                        'sucsess' => 1,
                        'user' => $user,
                        'token' => $token
                    ], 200);*/
                    return View('home');
                }
            } catch (Exception $e) {
                return response()->json([
                    'sucsess' => 0,
                    'result' => null,
                    'message' => $e,
                ], 200);
            }
        }
        return View('login');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            try {
                $request->validate([
                    "email" => 'required|string|email|unique:users',
                    'first_name' => 'required|string',
                    'mid_name' => 'required|string',
                    'last_name' => 'required|string',
                    "password" => "string|required|min:6",
                    "phone_number" => 'required|unique:users,phone_number',
                    'address' => 'required|string'
                ]);
                /*$validation = Validator::make($request->all(), [
                    "email" => 'required|string|email|unique:users',
                    'first_name' => 'required|string',
                    'mid_name' => 'required|string',
                    'last_name' => 'required|string',
                    "password" => "string|required|min:6",
                    "phone_number" => 'required|unique:users,phone_number',
                    'address' => 'required|string'
                ]);

                if ($validation->fails()) {
                    return response()->json([
                        'sucsess' => 0,
                        'result' => null,
                        'message' => $validation->errors(),
                    ], 200);
                }*/
                $user = User::create([
                    'email' => $request->email,
                    'first_name' => $request->first_name,
                    'mid_name' => $request->mid_name,
                    'last_name' => $request->last_name,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                    'password' => Hash::make($request->password),

                ]);
                $token = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
                if($token){
                    return View('home');
                }
                else{
                    return View('register');
                }
            }
            /* return response()->json([
                'sucsess' => 1,
                'user' => $user,
                'message' => 'user created sucsessfully'
            ], 200);*/ catch (Exception $e) {
                return response()->json([
                    'sucsess' => 0,
                    'result' => null,
                    'message' => $e->getMessage(),
                ], 200);
            }
        }
        return View('register');
    }
    public function logout()
    {
        auth()->logout();
        return View('logout'); # This is just logout function that will destroy access token of current user

        //  return response()->json(['message' => 'Successfully logged out']);
    }
    public function me()
    {
        # Here we just get information about current user
        //  return response()->json(auth()->user());
        return View('profile');
    }
    public function home()
    {
        return View('home');
    }
}
