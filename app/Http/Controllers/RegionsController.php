<?php

namespace App\Http\Controllers;

use App\Models\Provinces;
use App\Models\Regions;
use Illuminate\Http\Request;

class RegionsController extends Controller
{
    public function cities (){
        $Gov = Provinces::get();
        return view('Dashbord.Region.index' , compact('Gov'));
    }

    public function get_cities (){
        $cities = Regions::get();
        if ($cities) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $cities
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function index_show()
    {
        $Gov = Provinces::get();
        return view('Dashbord.Region.show' , compact('Gov'));
    }

    public function show ($id){
        $cities = Regions::where('province_id' , $id)->get();
        if ($cities) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $cities 
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function add_Cities (Request $request){
        Regions::create($request->all());
        return response()->json([
            'message' => trans('category.success_add_property'),
            'status' => 200,
            // 'data' => $Cities
        ]);
    }



    public function edit ($id){
        $Cities = Regions::with('provinces')->find($id);
        if ($Cities) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $Cities
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function update (Request $request , $id){
        $Cities = Regions::find($id);
        if ($Cities) {
            $Cities->update($request->all());
            return response()->json([
                'message' => trans('category.success_update_property'),
                'status' => 200,
                'data' => $Cities
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
        $Cities = Regions::find($id);
        if ($Cities) {
            $Cities->delete();
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
        $categories = Regions::find($id);
        $categories->status = request('status');
        $categories->update();
        return response()->json([
            // 'message' => 'Update Success',
            'status' => 200,
        ]);
    }
}