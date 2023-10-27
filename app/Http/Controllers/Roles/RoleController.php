<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function view() {
        return view('roles.index');
    }

    public function index(Request $request) {
        $role_data = [];
        $draw = $request->draw;
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        $order = $request->order[0]['column'] ?? null;
        $sort_order = $request->order[0]['dir'] ?? null;
        $filter = $request->search['regex'];
        $sort_query = null;
        if ($order) {
            $sort_query = $request->columns[$order]['data'];
        }
        if(!empty($search)) {
            $role_data = Role::where('name', 'like', '%' . $search . '%');
        }else {
            if (!empty($sort_order) && !empty($sort_query)) {
                $role_data =Role::orderBy($sort_query,$sort_order);
            }else{
                $role_data = Role::orderBy('created_at','desc');
            }
        }
        if($filter == "filter"){
            $role_data = Role::whereMonth('created_at','=',$search);
        }
        $count = $role_data->get()->count();
        $data = [
            "draw"=> $draw,
            "recordsTotal"=> $count,
            "recordsFiltered"=> $count,
        ];
        $data['data'] = $role_data->where('name', '!=' ,'admin')->skip($start)->take((int)$length)->get()->map(function ($record) {
            $record->role_id = encrypt($record->id);
            return $record;
        });
        return response()->json($data);
    }

    public function createView(Request $request) {
        $permissions = Permission::all()->groupBy('group')->map(function ($groupPermissions) {
            return $groupPermissions->map(function ($permission) {
                return [
                    'id' => $permission->id,
                    'name' => $permission->name,
                ];
            });
        })->toArray();

        return view('roles.create', compact('permissions'));
    }

    // role create and add role permissions
    public function create(Request $request) {
        $role = Role::where('name', $request->name)->first();

        if (! empty($role)) {
            return redirect()->back()->with('error', 'Role already exists');
        }

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions ?? []);
        return redirect()->route('roles.index')->with('message', 'Role create successful');
    }

    public function edit($id) {
        $role = Role::find(decrypt($id));
        $roleHasPermissions = collect($role->permissions)->pluck('id')->toArray();
        $permissions = Permission::all()->groupBy('group')->map(function ($groupPermissions) {
            return $groupPermissions->map(function ($permission) {
                return [
                    'id' => $permission->id,
                    'name' => $permission->name,
                ];
            });
        })->toArray();
        return view('roles.update', compact('role', 'roleHasPermissions', 'permissions'));
    }

    public function update($id, Request $request) {
        $role = Role::find(decrypt($id));

        if(empty($role)) {
            return redirect()->back()->with('error', 'Role not exists');
        }

        $role->update(['name' => $request->name]);
        Log::info("data",[$request->permissions]);
        $role->syncPermissions($request->permissions ?? []);
        return redirect()->route('roles.index')->with('message', 'Role permission updated successful');

    }

    public function show($id){
        $role = Role::find(decrypt($id));
        $rolePermission = $role->permissions;
        return view('roles.view', compact('role', 'rolePermission'));
    }

    public function delete($id) {
        $role = Role::find(decrypt($id));
        $role->delete();
        return view('roles.index')->with('message', 'Role deleted successfully');
    }
}
