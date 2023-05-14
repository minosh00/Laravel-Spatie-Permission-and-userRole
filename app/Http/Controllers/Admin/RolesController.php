<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
  public  function index(){

    $roles = Role::whereNotIn('name', ['admin'])->get();

  return view('admin.roles.index',compact('roles'));
  }


public function create(){
    return view('admin.roles.create');
}

public function store(Request $request){

    $validated = $request->validate(['name' => ['required', 'min:3'] ]);
    Role::create($validated);

    return  to_route('admin.roles.index');

}

public function edit(Role $role){
     return view('admin.roles.edit' ,  compact('role'));
}

public function update(Request $request, Role $role){
    $validated = $request->validate(['name' => ['required', 'min:3'] ]);
    $role->update($validated);
    return  to_route('admin.roles.index');


}

public function destroy(Role $role){
    $role->delete();
    return back()->with('message', 'role deleted');
}
}
