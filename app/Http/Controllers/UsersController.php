<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Exports\WorkersExport;
use App\Http\Repositories\AppUserRepositories;
use App\Models\Categories;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
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
        $admin->status = 'active';
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

    public function edit_admin()
    {
        $id=auth()->user()->id;
        $user = User::find($id);

        return view('Dashbord.Users.edit',compact('user'));
    }

    public function update_admin(Request $request)
    {
 
        $id=$request->id;
 
        $rules = [
            'email' => 'required|email|unique:users,email,'.$id,
        ];

        $validation = $request->validate($rules);

        $users = User::find($id);
        $users->first_name = $request->first_name;
        $users->email = $request->email;
        $users->save();
        session()->flash('success', 'تم تعديل المستخدم بنجاح ');
        return redirect('/');
    }

    public function reset_Password()
    {
        $id=auth()->user()->id;
        $user = User::find($id);
        return view('Dashbord.Users.reset_password',compact('user'));
    }

    public function resetPassword(Request $request)
    {
 
        $rules = [
            'old_password' => 'required|min:3',
            'new_password' => 'required|min:3',
            'confirm_password' => 'required|min:3|same:new_password',
        ];
        $validated = $request->validate($rules);
        $user = auth()->user();
        if (!Hash::check($request->get('old_password'), $user->password)) {
            $message = __('api.old_password'); //wrong old
            return redirect()->back()->with('delete' , 'كلمة السر القديمة خاطئة');
        }else{
            $user->password = bcrypt($request->get('new_password'));
            $user->save();
            return redirect('/');
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
        // return $request->all();
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
        // $query = User::select(
        //     'id' , 'first_name' , 'last_name' , 'mobile_number'  , 'status' , 'regino_id'
        // )->with(['regino' , 'Categories']);
        // dd($query->get());
        $cat = Categories::get();
        return view('Dashbord.Users.worker_index' , compact('cat'));
    }

    public function get_workers (Request $request , AppUserRepositories $customers){
        $dataTable = $customers->getDataTableClasses($request->all());
        $dataTable->addIndexColumn();
        $dataTable->escapeColumns(['*']);
        return $dataTable->make(true);
    }

    public function export_workers (Request $request) 
    {
        return Excel::download(new WorkersExport($request), 'Workers.xlsx');
    }

    public function customers(){
        return view('Dashbord.Users.customer_index');
    }

    public function get_customers (Request $request , AppUserRepositories $customers){
        $dataTable = $customers->getDataTableClasses($request->all());
        $dataTable->addIndexColumn();
        $dataTable->escapeColumns(['*']);
        return $dataTable->make(true);
    }

    public function export(Request $request) 
    {
        return Excel::download(new UsersExport($request), 'Custmers.xlsx');
    }
}
