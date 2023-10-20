<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;


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
        $start_number = intval((int)$start * (int)$length);
        if(!empty($search)) {
            $role_data = Role::where('name', 'like', '%' . $search . '%')->orWhere('email','like','%' . $search . '%');
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
        $data['data'] = $role_data->skip($start_number)->take((int)$length)->get();
        return response()->json($data);
    }

    // role create and add role permissions
    public function create(Request $request) {
        // todo Auto-generated method stub
    }

    public function edit($id, $request) {
        // todo Auto-generated method stub
    }

    public function update($id, $request) {
        // Todo Auto-generated method stub
    }

    public function delete($id, $request) {
        // TODO Auto-generated method stub
    }
}
