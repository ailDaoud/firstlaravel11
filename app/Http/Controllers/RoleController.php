<?php

namespace App\Http\Controllers;

use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $p = Role::all();
        return View('roles.indexp', compact('p'));
    }

    public function create()
    {
        return View('roles.create');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'unique:roles,name'
                ],
            ]
        );
        Role::create(['guard_name' => 'web','name' => $request->name]);
        return redirect('role')->with('status', 'roles created Sucsessfully');
    }

    public function edit($rId)
    {
        $item = Role::findOrFail($rId);
        return View('roles.edit', compact('rId', 'item'));
    }

    public function update(Request $request, $rId)
    {
        $item = Role::findOrFail($rId);
        $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'unique:roles,name'
                ],
            ]
        );
        $item->name = $request->name;
        $item->save();
        return redirect('role')->with('status', 'role created Sucsessfully');
    }


    public function destroy($rId)
    {
        $p = Role::findOrFail($rId);
        $p->delete();
        return redirect('role')->with('status', 'roles deleted Sucsessfully');
    }
    public function givep($rId)
    {
        $p = Permission::all();
        $role = Role::findOrFail($rId);
        return View('roles.add-per', compact('role', 'p'));
    }
    public function updatep(Request $request, $rId)
    {
        $request->validate(
            [
                'permission' => [
                    'required',
                ],
            ]
        );
        $role = Role::findOrFail($rId);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('status', 'roles');
    }
}
