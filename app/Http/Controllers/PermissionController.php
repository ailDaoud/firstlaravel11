<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Contracts\Permission as ContractsPermission;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        $p=Permission::all();
        return View('permission.indexp',compact('p'));
    }

    public function create(){
        return View('permission.create');
    }
    public function store(Request $request){
        $request->validate(
           [
            'name'=>[
                'required',
                'string',
                'unique:permissions,name'
            ],
           ]
        );
        Permission::create(['name'=>$request->name]);
        return redirect('permission')->with('status','Permission created Sucsessfully');
    }

    public function edit($pId){
        $item=Permission::findOrFail($pId);
        return View('permission.edit',compact('pId','item'));
    }

    public function update(Request $request,$pId){
        $item=Permission::findOrFail($pId);
        $request->validate(
            [
             'name'=>[
                 'required',
                 'string',
                 'unique:permissions,name'
             ],
            ]
         );
         $item->name=$request->name;
         $item->save();
         return redirect('permission')->with('status','Permission updated Sucsessfully');
    }

    public function destroy($pId){
       $p=Permission::findOrFail($pId);
        $p->delete();
        return redirect('permission')->with('status','Permission deleted Sucsessfully');
    }
}
