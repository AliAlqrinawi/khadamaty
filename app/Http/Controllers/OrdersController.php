<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Http\Repositories\OrderRepositories;
use App\Models\Orders;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrdersController extends Controller
{
    public function orders(){
        return view('Dashbord.Order.index');
    }

    public function get_orders(Request $request , OrderRepositories $orders){
        $dataTable = $orders->getDataTableClasses($request->all());
        $dataTable->addIndexColumn();
        $dataTable->escapeColumns(['*']);
        return $dataTable->make(true);
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

    public function export(Request $request) 
    {
        // return $request->all();
        return Excel::download(new OrdersExport($request), 'Orders.xlsx');
    }
}