<?php

namespace App\Http\Repositories;

use App\Models\AppUser;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class AppUserRepositories
{

    public function getDataTableClasses(array $data)
    {
        $query = User::query();
        $skip = $data['start'] ?? 0;
        $take = $data['length'] ?? 25;
        $custmer = $data['custmer'] ?? null ;
        $phone = $data['phone'] ?? null ;
        $status = $data['payment_status'] ?? Null ;
        $type = $data['type'] ?? '2';
        $worker = $data['worker'] ?? null;
        $cat_id = $data['cat_id'] ?? null ;
        if($type == '3'){
            if ($phone){
                $query->where('mobile_number' , $phone);
            }
            if ($worker){
                $query->where('first_name' , $worker);
            }
            if ($status){
                $query->where('status' , $status);
            }
            if ($cat_id){
                $query->where('cat_id' , $cat_id);
            }
            $count = $query->count();
            $info = $query->orderBy('id', 'desc')->where('type' , '3')->with('Categories')->skip($skip)->take($take);
            return Datatables::of($info)->setTotalRecords($count);
        }else{
            if ($phone){
                $query->where('mobile_number' , $phone);
            }
            if ($custmer){
                $query->where('first_name' , $custmer);
            }
            if ($status){
                $query->where('status' , $status);
            }
            $count = $query->count();
            $info = $query->orderBy('id', 'desc')->where('type' , '2')->skip($skip)->take($take);
            return Datatables::of($info)->setTotalRecords($count);
    }
    }
}
