<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function orders(){
        return view('Dashbord.Order.index');
    }

    public function get_orders(){
        $Orders = Orders::with('Custmers' , 'Workers.Categories')->get();
        if ($Orders) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $Orders
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function delete ($id){
        $category = Orders::find($id);
        if ($category) {
            $category->delete();
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