<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function view() {
        return view('users.index');
    }

    public function index(Request $request) {
        $user_data = [];
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
            $user_data = User::where('first_name', 'like', '%' . $search . '%')
                                ->orWhere('last_name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%')
                                ->orWhere('phone_number', 'like', '%' . $search . '%');
        }else {
            if (!empty($sort_order) && !empty($sort_query)) {
                $user_data = User::orderBy($sort_query,$sort_order);
            }else{
                $user_data = User::orderBy('created_at','desc');
            }
        }
        if($filter == "filter"){
            $user_data = User::whereMonth('created_at','=',$search);
        }
        $count = $user_data->get()->count();
        $data = [
            "draw"=> $draw,
            "recordsTotal"=> $count,
            "recordsFiltered"=> $count,
        ];
        $data['data'] = $user_data->where('email', '!=' ,env('Email') ?? 'admin@gmail.com')->skip($start)->take((int)$length)->get()->map(function ($record) {
            $record->user_id = encrypt($record->id);
            return $record;
        });
        return response()->json($data);
    }

    public function createView(Request $request) {
        $roles = Role::where('name', '!=' ,'admin')->get();
        return view('users.create', compact('roles'));
    }

    public function create(Request $request) {
        try {
            $user = User::where('email', $request->email)->first();

            if (! empty($user)) {
                return redirect()->back()->with('error', 'User already exists');
            }

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $request->password,
                'phone_number' => $request->phone_number ?? null,
                'gender' => $request->gender ?? null,
                'dob'   => $request->dob ?? null,
            ]);

            $user->assignRole($request->role ?? 0);
            return view('users.index')->with('message', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id, Request $request) {
        $user = User::findWithCache(decrypt($id));
        $roles = Role::where('name', '!=' ,'admin')->get();
        return view('users.update', compact('user','roles'));
    }

    public function update($id, Request $request) {
        try {
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number ?? null,
                'gender' => $request->gender ?? null,
                'dob'   => $request->dob ?? null,
            ];

            $user = User::find(decrypt($id));

            if(empty($user)) {
                return redirect()->back()->with('error', 'User not found');
            }

            $user->update($data);
            return redirect()->route('users.index')->with('message', 'User updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function userView($id) {
        $user = User::findWithCache(decrypt($id));
        return view('users.view', compact('user'));
    }
}
