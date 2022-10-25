<?php

namespace App\Http\Controllers;

use App\Models\Packages;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function package (){
        return view('Dashbord.package.index');
    }

    public function get_packages (){
        $packages = Packages::get();
        if ($packages) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $packages
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function add_package (Request $request){
        Packages::create($request->all());
        return response()->json([
            'message' => trans('category.success_add_property'),
            'status' => 200,
            // 'data' => $package
        ]);
    }

    public function edit ($id){
        $package = Packages::find($id);
        if ($package) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $package
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function update (Request $request , $id){
        $package = Packages::find($id);
        if ($package) {
            $package->update($request->all());
            return response()->json([
                'message' => trans('category.success_update_property'),
                'status' => 200,
                'data' => $package
            ]);
            }
          else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        $id = $request->id;
        $categories = Packages::find($id);
        $categories->status = request('status');
        $categories->update();
        return response()->json([
            'message' => 'Update Success',
            'status' => 200,
        ]);
    }

    public function delete ($id){
        $package = Packages::find($id);
        if ($package) {
            $package->delete();
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
}
