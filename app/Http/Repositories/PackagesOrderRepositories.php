<?php

namespace App\Http\Repositories;

use App\Models\PackageOrder;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Facades\DataTables;

class PackagesOrderRepositories
{

    public function getDataTableClasses(array $data)
    {
        $query = PackageOrder::query();
        $skip = $data['start'] ?? 0;
        $take = $data['length'] ?? 25;
        $worker = $data['worker'] ?? null ;
        $package = $data['package'] ?? null;
        $phone = $data['phone'] ?? Null ;
        $cat_id = $data['cat_id'] ?? Null ;
        if ($worker){
            $query->whereHas('workers', function ($query) use($worker) {
                $query->where('first_name' , '=' , $worker);
            });
        }
        if ($package){
            $query->whereHas('Packages', function ($query) use($package) {
                $query->where('title_ar' , '=' , $package)->Orwhere('title_en' , '=' , $package);
            });
        }
        if ($phone){
            $query->whereHas('workers', function ($query) use($phone) {
            $query->where('mobile_number' , '=' , $phone);
        });
        }
        if ($cat_id){
            $query->whereHas('Workers.Categories', function ($query) use($cat_id) {
            $query->where('id' , '=' , $cat_id);
        });
        }
        $count = $query->count();
        $info = $query->orderBy('id', 'desc')->with('Workers.Categories' , 'Packages')->skip($skip)->take($take);
        return Datatables::of($info)->setTotalRecords($count);
    }
}
