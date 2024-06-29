<?php

namespace App\Http\Controllers;

use App\Customs\services\EmailVerificationService;
use App\Mail\MyEmail;
use App\Models\VerifyOtp;
use Illuminate\Http\Request;
use Illuminate\Session\SessionServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Exception;
use Illuminate\View\View;
use App\Http\Controllers\sessionStorage;
use App\Models\Ads;
use App\Models\EmailOTP;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageFactoryInterface;
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;

class AuthController extends Controller
{
    public function __construct(private EmailVerificationService $Service)
    {
    }
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
                    return response()->json([
                        'sucsess' => 0,
                        'result' => null,
                        'message' => 'register first',
                    ], 200);
                    // return to_route('login')->with('error', 'Invalid login');
                } else {
                    $user = User::where('email', $request->email)->first();
                    Session::put('token', $token);
                    session(['key' => 'value']);
                    /* return response()->json([
                        'sucsess' => 1,
                        'user' => $user,
                        'token' => Session::get('token'),
                    ], 200);
                   /*  Session::put('token',$token);
                    session(['token' => $token]);
                    session(['key' => 'value']);
                    $request->session()->put('key', 'value');
                    return View('home');
                  /* return response()->json([
                    'sucsess' => 1,
                   // 'user' => $user,
                    'token' => Session::get('token')
                ], 200);*/
                $data=Ads::all();
                    return View('home',compact('data'));
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
                if($user){
                   $validotp=rand(000000,999999);
                   $get_otp=new VerifyOtp();
                   $get_otp->code=$validotp;
                   $get_otp->email=$user->email;
                   $get_otp->save();
                   $get_user_email=$user->email;
                   $get_user_first_name=$user->first_name;
                   Mail::to($user->email)->send(new MyEmail($get_user_email,$validotp,$get_user_first_name) );
                    $data=Ads::all();
                    return View('otp_verify');//View('home',compact('data'));
                }
               /* $token = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
                if ($token) {
                    return View('home');
                }*/ else {
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

        //     return response()->json(['message' => 'Successfully logged out']);
    }
    public function profile(Request $request)
    {
        # Here we just get information about current user
        //  return response()->json(auth()->user());
        if ($request->isMethod('post')) {
            $request->validate([
                "email" => 'required|string|email|unique:users',
                'first_name' => 'required|string',
                "phone_number" => 'required|unique:users,phone_number',
            ]);
            $user = new User;
            if ($user) {
                $user->first_name = $request->first_name;
                $user->phone_number = $request->phone_number;
                $user->save();
            }
        }

        return View('profile');
    }
    public function home()
    {
        return View('home');
    }
    public function verify_otp(Request $request){
        if($request->isMethod('post')){
          $get_otp=$request->code;
          $get_otp=VerifyOtp::where('code',$get_otp)->first();
          if($get_otp){
            $get_otp->is_active=1;
            $get_otp->save();
            $user=User::where('email',$get_otp->email)->first();
            if($user){
                $user->is_active=1;
                $user->save();
                $del_otp=VerifyOtp::where('code',$get_otp->code)->first();
                $del_otp->delete();
               redirect('/home')->with('active');
            }
            else{
                return redirect('/otp_verify')->with('wrong_otp','Wrong OTP');
            }
          }
          else{
            return redirect('/otp_verify')->with('wrong','Something went wrong');
        }
        }
        return View('otp_verify');
    }
}
