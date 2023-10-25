<?php

namespace App\Http\Controllers\Permissions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function view() {
        return view('permissions.index');
    }

    public function index(Request $request) {
        $permission_data = [];
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
            $permission_data = Permission::where('name', 'like', '%' . $search . '%')->orWhere('slug','like','%' . $search . '%');
        }else {
            if (!empty($sort_order) && !empty($sort_query)) {
                $permission_data =Permission::orderBy($sort_query,$sort_order);
            }else{
                $permission_data = Permission::orderBy('created_at','desc');
            }
        }
        if($filter == "filter"){
            $permission_data = Permission::whereMonth('created_at','=',$search);
        }
        $count = $permission_data->get()->count();
        $data = [
            "draw"=> $draw,
            "recordsTotal"=> $count,
            "recordsFiltered"=> $count,
        ];
        $data['data'] = $permission_data->skip($start)->take((int)$length)->get();
        return response()->json($data);
    }
}
