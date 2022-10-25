<?php

namespace App\Http\Controllers;

use App\Models\Fav;
use Illuminate\Http\Request;

class FavsController extends Controller
{
    public function Fav(){
        return view('Dashbord.Fav.index');
    }

    public function get_Fav(){
        $Fav = Fav::orderBy('id' , 'desc')->with('Workers.Categories')->get();
        if ($Fav) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $Fav
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function delete ($id){
        $fav = Fav::find($id);
        if ($fav) {
            $fav->delete();
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