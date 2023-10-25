<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
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
        $data['data'] = $role_data->skip($start)->take((int)$length)->get();
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
        // todo Auto-generated method stub
    }

    public function edit($id) {
        dd(decrypt(encrypt($id)));
        $role = Role::find($id);
        $roleHasPermission = collect($role->permissions)->pluck('id')->toArray();
        $permissions = Permission::all()->groupBy('group')->map(function ($groupPermissions) {
            return $groupPermissions->map(function ($permission) {
                return [
                    'id' => $permission->id,
                    'name' => $permission->name,
                ];
            });
        })->toArray();
        return view('roles.update', compact('role', 'roleHasPermission', 'permissions'));
    }

    public function update($id, $request) {
        // Todo Auto-generated method stub
    }

    public function delete($id, $request) {
        // TODO Auto-generated method stub
    }
}
