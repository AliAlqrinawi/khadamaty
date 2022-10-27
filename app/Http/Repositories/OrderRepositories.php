<?php

namespace App\Http\Repositories;

use App\Models\Orders;
use Yajra\DataTables\Facades\DataTables;

class OrderRepositories
{

    public function getDataTableClasses(array $data)
    {
        $query = Orders::query();
        $skip = $data['start'] ?? 0;
        $take = $data['length'] ?? 25;
        $custmer = $data['custmer'] ?? null ;
        $worker = $data['worker'] ?? Null ;
        $phone = $data['phone'] ?? Null ;
        // $payment_status = $data['payment_status'] ?? 0.000 ;
        if ($custmer){
            // $query->where('status' , $custmer);
            $query->whereHas('custmers', function ($query) use($custmer) {
                $query->where('first_name' , '=' , $custmer);
            });
        }
        if ($worker){
            $query->whereHas('custmers', function ($query) use($worker) {
                $query->where('first_name' , '=' , $worker);
            });
        }
       if ($phone){
           $query->whereHas('custmers', function ($query) use($phone) {
            $query->where('mobile_number' , '=' , $phone);
        });
       }
        // if ($payment_status){
        //     $query->where('payment_status' , $payment_status);
        // }
        $count = $query->count();
        $info = $query->orderBy('id', 'desc')->with('Custmers' , 'Workers.Categories')->skip($skip)->take($take);
        return Datatables::of($info)->setTotalRecords($count);
//        $query = Order::query();
//        $skip = $data['start'] ?? 0;
//        $take = $data['length'] ?? 25;
//        $info = $query->orderBy('id', 'desc')->with('user' , 'payment' , 'address' , 'deliveryTypeTitle' , 'pieces')->skip($skip)->take($take);
//        $count = $this->countDataTableClasses($data);
//        return Datatables::of($info)->setTotalRecords($count);
    }
//
//    public function countDataTableClasses(array $data)
//    {
//        $query = Order::query();
//
//        return $query->count('id');
//    }
}
