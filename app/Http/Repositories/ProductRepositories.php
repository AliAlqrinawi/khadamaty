<?php

namespace App\Http\Repositories;

use App\Models\Clothes;
use Yajra\DataTables\Facades\DataTables;

class ProductRepositories
{

    public function getDataTableClasses(array $data)
    {
        $query = Clothes::query();
        $skip = $data['start'] ?? 0;
        $take = $data['length'] ?? 25;
        $status = $data['status'] ?? 0 ;
        if ($status){
            if ($status == '1'){
                $query->where('status','1');
            }else{
                $query->where('status','!=','1');
            }
        }
        $count = $query->count();
        $info = $query->orderBy('id', 'desc')->with('categories')->skip($skip)->take($take);
        return Datatables::of($info)->setTotalRecords($count);
    }

//    public function countDataTableClasses(array $data)
//    {
//        $query = Clothes::query();
//
//        return $query->count('id');
//    }
}
