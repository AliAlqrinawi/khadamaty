<?php

namespace App\Http\Controllers;

use App\Exports\PackageOrderExport;
use App\Http\Repositories\PackagesOrderRepositories;
use App\Models\Categories;
use App\Models\PackageOrder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
class PackageOrdersController extends Controller
{
    public function PackageOrder(){
        $cat = Categories::get();
        return view('Dashbord.PackageOrder.index' , compact('cat'));
    }

    public function get_PackageOrder(Request $request , PackagesOrderRepositories $PackagesOrder){
        // return $request->all();
        $dataTable = $PackagesOrder->getDataTableClasses($request->all());
        $dataTable->addIndexColumn();
        $dataTable->escapeColumns(['*']);
        return $dataTable->make(true);
        // $PackageOrder = PackageOrder::with('Workers.Categories' , 'Packages')->get();
        // if ($PackageOrder) {
        //     return response()->json([
        //         'message' => 'Data Found',
        //         'status' => 200,
        //         'data' => $PackageOrder
        //     ]);
        // } else {
        //     return response()->json([
        //         'message' => 'Data Not Found',
        //         'status' => 404,
        //     ]);
        // }
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

    public function print() 
    {
        $pdf = PDF::loadView('Dashbord.PackageOrder.printOrder');
        return $pdf->download('sample.pdf');
    }

    public function export(Request $request) 
    {
        return Excel::download(new PackageOrderExport($request), 'Package Order.xlsx');
    }
}
