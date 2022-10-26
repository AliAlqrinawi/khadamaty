<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UsersController extends Controller
{
    public function admins(){
        $role = Role::get();
        return view('Dashbord.Users.admin_index' , compact('role'));
    }

    public function get_admins (){
        $admins = User::where('type' , '1')->get();
        if ($admins) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $admins
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function add_admin (Request $request){
        $admin = new User();
        $admin->first_name = $request->name;
        $admin->email = $request->email;
        $admin->type = '1';
        // $admin->mobile = $request->phone;
        // $admin->type = $request->role;
        $admin->password = Hash::make($request->password);
        $admin->save();
        $role_user = new RoleUser();
        $role_user->role_id = $request->role;
        $role_user->user_id = $admin->id;
        $role_user->save();
        return response()->json([
            'message' => trans('category.success_add_property'),
            'status' => 200,
            'data' => $admin
        ]);
    }

    public function edit ($id){
        $admin = User::find($id);
        if ($admin) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $admin
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function update (Request $request , $id){
        $admin = User::find($id);
        // $role_user = RoleUser::where('user_id' , $id)->first();
        if ($admin) {
            $admin->first_name = $request->name;
            $admin->email = $request->email;
            $admin->update();
            // $role_user->role_id = $request->role;
            // $role_user->user_id = $admin->id;
            // $role_user->save();
            DB::table('role_user')
            ->where('user_id' , $id)
            ->update(['role_id' => $request->role]);
            return response()->json([
                'message' => trans('category.success_update_property'),
                'status' => 200,
                'data' => $admin
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    
    public function delete ($id){
        $admin = User::find($id);
        if ($admin) {
            $admin->delete();
            return response()->json([
                'message' => trans('category.property_delete_success'),
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        $id = $request->id;
        $categories = User::find($id);
        $categories->status = request('status');
        $categories->update();
        return response()->json([
            'status' => 200,
        ]);
    }

    // Workers

    public function Workers(){

        return view('Dashbord.Users.worker_index');
    }

    public function get_workers (){
        $workers = User::where('type' , '3')->with('Categories')->get();
        if ($workers) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $workers
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    // Custmer
    public function customers(){

        return view('Dashbord.Users.customer_index');
    }

    public function get_customers (){
        $workers = User::where('type' , '2')->get();
        if ($workers) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $workers
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }
}
