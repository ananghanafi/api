<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;

class RolePermissionController extends Controller
{

    public function index(Request $request)
    {
        if(!Auth::user()->hasRole('superadmin')){
            abort(401);
        }
        if($request->role_id) 
            $role_id = $request->role_id; 
        else  
            $role_id = 3;
     
        $role = \App\Models\Role::find($role_id);
        $roles = \App\Models\Role::where('id','>',1)->get();
   
        $groups = \App\Models\Group::with(['permissions.roles' => function ($query) use ($role_id) {
                    $query->where('role_id', '=', $role_id);
                }])->get();
        return view('editperan',['groups' => $groups, 'role' => $role , 'roles' => $roles]);
    }
  
    public function store(Request $request) {
        if(!Auth::user()->hasRole('superadmin')){
            abort(401);
        }
        $perms = $request->perms;
        $role_id = $request->role_id;
        \DB::beginTransaction();
        \App\Models\PermissionRole::whereRoleId($role_id)->delete();
        if (is_array($perms)) {
            foreach ($perms as $value) {
                \App\Models\PermissionRole::insert([
                    'permission_id' => $value,
                    'role_id' => $role_id
                ]);
            }
        }
        \DB::commit();
        return redirect(route('peran', ['role_id' => $role_id]));
    }
    
    public function updatePermission(){
        if(!Auth::user()->hasRole('superadmin')){
            abort(401);
        }
        $allRoute = \Route::getRoutes();
        
        \App\Models\PermissionRole::where('role_id','>',0)->delete();
        \App\Models\PermissionGroup::where('group_id','>',0)->delete();
        \App\Models\Permission::where('id','>',0)->delete();
        \App\Models\Group::where('id','>',0)->delete();
        
        
        $i = 1;
        $i_grup = 1;
        foreach ($allRoute as $route) {
            $attributes = $route->getAction();
            $name = $route->getName();
            $display_name = isset($attributes['display_name']) ? $attributes['display_name'] : null;
            $description = isset($attributes['description']) ? $attributes['description'] : null;

            $route = explode('.', $name);
            if($route[0] != 'permission'){
                continue;
            }
            
            $group_name = $route[1];
            $group = \App\Models\Group::whereName($group_name)->first();
            if(!$group){
                $group = \App\Models\Group::create(
                    [
                        'id' => $i_grup,
                        'name' => $group_name,
                        'display_name' => $group_name,
                    ]);
                
                $i_grup++;
            }
            
            $perm = \App\Models\Permission::create([
                    'id' => $i,
                    'name' => $name,
                    'display_name' => $name,
                    'description' => $name,
                ]
            );
            
            \App\Models\PermissionGroup::insert([
                    'group_id' => $group->id,
                    'permission_id' => $perm->id,
                ]
            );
            
            $roles = \App\Models\Role::where('id','>',1)->get();
            foreach ($roles as $role) {
                \App\Models\PermissionRole::create([
                        'permission_id' => $perm->id,
                        'role_id' => $role->id
                    ]
                );
            }
            
            
            $i++;
        }
        return "OK";
    }
    
}
