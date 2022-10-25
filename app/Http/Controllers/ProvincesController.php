<?php

namespace App\Http\Controllers;

use App\Models\Provinces;
use Illuminate\Http\Request;

class ProvincesController extends Controller
{
    public function Provinces (){
        return view('Dashbord.Province.index');
    }

    public function get_Provinces (){
        $Provinces = Provinces::get();
        if ($Provinces) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $Provinces
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function add_governorat (Request $request){
        Provinces::create($request->all());
        return response()->json([
            'message' => trans('category.success_add_property'),
            'status' => 200,
            // 'data' => $Provinces
        ]);
    }

    public function edit ($id){
        $Provinces = Provinces::find($id);
        if ($Provinces) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $Provinces
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function update (Request $request , $id){
        $Provinces = Provinces::find($id);
        if ($Provinces) {
            $Provinces->update($request->all());
            return response()->json([
                'message' => trans('category.success_update_property'),
                'status' => 200,
                'data' => $Provinces
            ]);
            }
          else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function delete ($id){
        $Provinces = Provinces::find($id);
        if ($Provinces) {
            $Provinces->delete();
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
        $Coupons = Provinces::find($id);
        $Coupons->status = request('status');
        $Coupons->update();
        return response()->json([
            'message' => 'Update Success',
            'status' => 200,
        ]);
    }
}
