<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Ads;
use App\Models\User;
use Resources\lang\ar;
use Resources\lang\en;
use Exception;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        /* $users = User::all();
        try {
            if ($users) {
                return response()->json([
                    'success' => 1,
                    'result' => $users,
                    'message' => "",
                ], 200);
            } else {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' =>  __('res.messagee'),
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e
            ], 200);
        }*/
        $p = User::all();
        return View('users.indexp', compact('p'));
    }
    function store1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'mid_name' => 'required|string',
            'password' => 'required|string|min:6',
            "email" => 'required|email|unique:users',
            "phone_number" => 'required', //|unique:users,phone_number',
            "address" => "string|required"
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $validator->errors(),
            ], 200);
        }
        try {
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->mid_name = $request->mid_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone_number = $request->phone_number;
            $user->address = $request->address;
            $user->save();

            return response()->json([
                'success' => 1,
                'result' => __('res.store'),
                'message' => ''
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e
            ], 200);
        }
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        if (!$user) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('res.show')
            ], 200);
        } else {
            return response()->json([
                'success' => 1,
                'result' => $user,
                'message' => ''
            ], 200);
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'mid_name' => 'required|string',
            'password' => 'required|string|min:6',
            "email" => 'required|email|unique:users,email',
            "phone_number" => 'required|unique:users,phone_number',
            "address" => "string|required",
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $validator->errors(),
            ], 200);
        }
        try {
            $user = User::findOrFail($id);
            if ($user) {
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->mid_name = $request->mid_name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->phone_number = $request->phone_number;
                $user->address = $request->address;
                $user->save();
                return response()->json([
                    'success' => 1,
                    'result' => $user,
                    'message' => __('res.update'),
                ], 200);
            } else {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' => __('res.show'),
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e
            ], 200);
        }
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->ads()->delete();
            $user->delete();
            return response()->json([
                'success' => 1,
                'result' => null,
                'message' => __('res.delete')
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('res.show')
            ], 200);
        }
    }
    public function destroy2($uId)
    {
        $p = User::findOrFail($uId);
        $p->delete();
        return redirect('users')->with('status', 'Permission created Sucsessfully');
    }
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return View('users.create', compact('roles'));
    }
    function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'mid_name' => 'required|string',
            'password' => 'required|string|min:6',
            "email" => 'required|email|unique:users',
            "phone_number" => 'required', //|unique:users,phone_number',
            "address" => "string|required",
            "roles" => "required"
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->mid_name = $request->mid_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->save();

        $user->syncRoles($request->roles);
        return redirect('/users');
    }
    public function modify($uId)
    {
        $roles = Role::pluck('name', 'name')->all();
        return View('users.modify_roles',compact('roles','uId'));
    }

    public function modify_roles(Request $request, $uid)
    {
        $request->validate([
            "roles" => "required"
        ]);

        $user = User::findOrFail($uid);
        $user->syncRoles($request->roles);
        return redirect('/users');
    }
}
/* <div class="form-group">
                <label for="">Permission in the permission table</label>
                <div class="row">
                    @foreach ($p as $p1)
                        <div class="col-md-3">
                            <label for=""></label>
                            <input type="checkbox" name="permission[]" value="{{ $p1->name }}" id="name"
                                placeholder="Name">
                                {{$p1->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div> */
