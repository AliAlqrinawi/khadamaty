<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdsController extends Controller
{
    public function ads (){
        return view('Dashbord.Ads.index');
    }

    public function get_ads (){
        $coupons = Ads::get();
        if ($coupons) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $coupons
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function add_ads (Request $request){
        $data = $request->except('image');
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $local =  request()->getSchemeAndHttpHost();
            $path = $file->storeAs('ads' , $filename ,  ['disk' => 'uploads']);
            $data['image']  = $local .'/'.'uploads/'.$path;
        }
        Ads::create($data);
        return response()->json([
            'message' => trans('category.success_add_property')
            ,
            'status' => 200,
        ]);
    }

    public function edit ($id){
        $Ads = Ads::find($id);
        if ($Ads) {
            return response()->json([
                'message' => 'Data Found',
                'status' => 200,
                'data' => $Ads
            ]);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'status' => 404,
            ]);
        }
    }

    public function update (Request $request , $id){
        $Ads = Ads::find($id);
        if ($Ads) {
            $data = $request->except('image');
            if ($request->hasFile('image')){
                if (File::exists($Ads->image)){
                    File::delete($Ads->image);
                }
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $local =  request()->getSchemeAndHttpHost();
                $path = $file->storeAs('ads' , $filename ,  ['disk' => 'uploads']);
                $data['image']  = $local .'/'.'uploads/'.$path;
                return $data['image'];
            }
            $data['status'] = '1';
            $Ads->update($data);
            return response()->json([
                'message' => trans('category.success_update_property'),
                'status' => 200,
                'data' => $Ads
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
        $Ads = Ads::find($id);
        if ($Ads) {
            $Ads->delete();
            return response()->json([
                'message' => trans('category.success_delete_property'),
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
        $Coupons = Ads::find($id);
        $Coupons->status = request('status');
        $Coupons->update();
        return response()->json([
            'message' => 'Update Success',
            'status' => 200,
        ]);
    }
}
