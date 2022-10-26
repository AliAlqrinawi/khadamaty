<?php

namespace App\Http\Controllers;

use App\Models\PackageOrder;
use Illuminate\Http\Request;

class PackageOrdersController extends Controller
{
    public function PackageOrder(){
        return view('Dashbord.PackageOrder.index');
    }

    public function get_PackageOrder(){
        $PackageOrder = PackageOrder::with('Workers.Categories' , 'Packages')->get();
        if ($PackageOrder) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $PackageOrder
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function delete ($id){
        $PackageOrder = PackageOrder::find($id);
        if ($PackageOrder) {
            $PackageOrder->delete();
            return response()->json([
                'message' => trans('PackageOrder.property_delete_success'),
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
        $categories = PackageOrder::find($id);
        $categories->status = request('status');
        $categories->update();
        return response()->json([
            'message' => 'Update Success',
            'status' => 200,
        ]);
    }
}
